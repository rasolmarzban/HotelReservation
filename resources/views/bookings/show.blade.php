<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900">Booking Details</h2>
                    </div>

                    <div class="space-y-6">
                        <!-- Booking Reference -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Booking Reference</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $booking->booking_reference }}</p>
                        </div>

                        <!-- Hotel Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Hotel Information</h3>
                            <div class="mt-2 grid grid-cols-1 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Hotel Name</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->hotel->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Location</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->hotel->location }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Room Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Room Information</h3>
                            <div class="mt-2 grid grid-cols-1 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Room Number</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->room->room_number }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Room Type</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->room->type }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Dates -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Booking Dates</h3>
                            <div class="mt-2 grid grid-cols-1 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Check-in Date</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->check_in->format('Y-m-d') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Check-out Date</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->check_out->format('Y-m-d') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Guest Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Guest Information</h3>
                            <div class="mt-2 grid grid-cols-1 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Number of Guests</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->number_of_guests }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Special Requests</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->special_requests ?? 'None' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Status -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Booking Status</h3>
                            <div class="mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 
                                       ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                        'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Total Price</h3>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">${{ number_format($booking->total_cost, 2) }}</p>
                        </div>

                        <!-- Back Button -->
                        <div class="flex justify-end">
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>