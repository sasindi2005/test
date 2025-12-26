@extends('layouts.app')

@section('page_title', 'Book Appointment')
@section('page_subtitle', 'Schedule a new appointment')

@section('content')

<div class="max-w-2xl bg-slate-900/50 border border-white/5 rounded-2xl p-6">
    <form action="{{ route('vet.appointments.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm text-slate-400 mb-1">Pet</label>
            <select name="pet_id"
                    class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-sky-500">
                <option value="">Select Pet</option>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                        {{ $pet->name }}
                    </option>
                @endforeach
            </select>
            @error('pet_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-slate-400 mb-1">Branch</label>
            <select name="branch_id"
                    class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-sky-500">
                <option value="">Select Branch</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
            @error('branch_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-slate-400 mb-1">Appointment Date & Time</label>
            <input type="datetime-local" name="appointment_at" value="{{ old('appointment_at') }}"
                   class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-sky-500">
            @error('appointment_at') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-slate-400 mb-1">Status</label>
            <select name="status"
                    class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-sky-500">
                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ old('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div>
            <label class="block text-sm text-slate-400 mb-1">Notes</label>
            <textarea name="notes"
                      class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-sky-500"
                      rows="3">{{ old('notes') }}</textarea>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('vet.appointments.index') }}"
               class="px-4 py-2 rounded-lg border border-white/10 text-slate-300 hover:bg-white/5 transition">
                Cancel
            </a>
            <button class="bg-sky-600 hover:bg-sky-500 text-white px-5 py-2 rounded-lg font-medium transition">
                Save Appointment
            </button>
        </div>
    </form>
</div>

@endsection
