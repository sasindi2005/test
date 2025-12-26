<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payHereRedirect(Order $order)
    {
        $merchant_id = env('PAYHERE_MERCHANT_ID');
        $merchant_secret = env('PAYHERE_SECRET');

        $hash = strtoupper(
            md5(
                $merchant_id .
                $order->order_number .
                number_format($order->total, 2, '.', '') .
                $order->currency .
                strtoupper(md5($merchant_secret))
            )
        );

        return view('payment.payhere', compact('order', 'merchant_id', 'hash'));
    }

    public function payHereNotify(Request $request)
    {
        // PayHere sends payment_id, order_id, payhere_amount, payhere_currency, status_code
        $orderNumber = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $paymentId = $request->input('payment_id');

        $order = Order::where('order_number', $orderNumber)->first();
        if (!$order) return response('Order not found', 404);

        if ($statusCode == 2) {
            // Payment success
            if ($order->payment_status !== 'paid') {
                $order->update([
                    'payment_status' => 'paid',
                    'payment_reference' => $paymentId,
                ]);

                // Reduce stock safely
                foreach ($order->items as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->decrement('stock', $item->qty);
                    }
                }

                // Clear cart
                session()->forget('cart');
            }
        } else {
            $order->update([
                'payment_status' => 'failed',
                'payment_reference' => $paymentId,
            ]);
        }

        return response('OK', 200);
    }

    public function success()
    {
        return view('payment.success');
    }

    public function failed()
    {
        return view('payment.failed');
    }
}
