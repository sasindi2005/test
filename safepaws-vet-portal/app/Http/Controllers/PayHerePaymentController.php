<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\PayHereService;

class PayHerePaymentController extends Controller
{
    // ✅ Create Payment Order and Redirect to PayHere
    public function pay(Request $request, Order $order)
    {
        $merchantId = env('PAYHERE_MERCHANT_ID');
        $merchantSecret = env('PAYHERE_MERCHANT_SECRET');
        $currency = env('PAYHERE_CURRENCY', 'LKR');

        $amount = $order->total_amount;
        $hash = PayHereService::generateHash($merchantId, $order->id, $amount, $currency, $merchantSecret);

        $data = [
            'merchant_id' => $merchantId,
            'return_url'  => route('payhere.return'),
            'cancel_url'  => route('payhere.cancel'),
            'notify_url'  => route('payhere.notify'),
            'order_id'    => $order->id,
            'items'       => "SafePaws Order #{$order->id}",
            'currency'    => $currency,
            'amount'      => number_format($amount, 2, '.', ''),
            'first_name'  => $order->customer_name,
            'last_name'   => "",
            'email'       => $order->customer_email ?? "customer@safepaws.lk",
            'phone'       => $order->phone,
            'address'     => $order->address,
            'city'        => "Sri Lanka",
            'country'     => "Sri Lanka",
            'hash'        => $hash
        ];

        return view('payments.payhere_checkout', compact('data'));
    }

    // ✅ Return URL (success redirect only)
    public function return()
    {
        return redirect()->route('orders.success')->with('success', 'Payment completed successfully!');
    }

    // ✅ Cancel URL
    public function cancel()
    {
        return redirect()->route('orders.failed')->with('error', 'Payment cancelled.');
    }

    // ✅ IPN Notification (Payment Verification & Order Update)
    public function notify(Request $request)
    {
        $merchantSecret = env('PAYHERE_MERCHANT_SECRET');

        $merchantId      = $request->merchant_id;
        $orderId         = $request->order_id;
        $payhereAmount   = $request->payhere_amount;
        $payhereCurrency = $request->payhere_currency;
        $statusCode      = $request->status_code;
        $receivedHash    = $request->md5sig;

        $generatedHash = strtoupper(md5(
            $merchantId .
            $orderId .
            number_format($payhereAmount, 2, '.', '') .
            $payhereCurrency .
            $statusCode .
            strtoupper(md5($merchantSecret))
        ));

        if ($generatedHash !== $receivedHash) {
            return response("Invalid hash", 400);
        }

        $order = Order::find($orderId);

        if (!$order) return response("Order not found", 404);

        // ✅ Payment Success
        if ($statusCode == 2) {
            if ($order->payment_status !== "paid") {
                $order->update([
                    'payment_status' => 'paid',
                    'payment_method' => 'payhere',
                    'payment_ref'    => $request->payment_id,
                    'status'         => 'processing'
                ]);

                // ✅ Reduce stock
                foreach ($order->items as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->stock = max(0, $product->stock - $item->quantity);
                        $product->save();
                    }
                }
            }
        }

        return response("OK", 200);
    }
}
