<!-- resources/views/bookings/create.blade.php -->
<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-900">Book Room at {{ $hotel->name }}</h2>

                    <form action="{{ route('hotel.book.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> <!-- Assuming the user is logged in -->

                        <!-- Room Details -->
                        <div>
                            <label for="room" class="block text-sm font-medium text-gray-700">Room</label>
                            <input type="text" id="room" name="room" value="{{ $room->room_number }} - {{ $room->type }}"
                                readonly class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Check-in Date -->
                        <div>
                            <label for="check_in" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                            <input type="date" name="check_in" id="check_in" required
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Check-out Date -->
                        <div>
                            <label for="check_out" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                            <input type="date" name="check_out" id="check_out" required
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Cost Estimate -->
                        <div>
                            <label for="cost_estimate" class="block text-sm font-medium text-gray-700">Cost Estimate</label>
                            <input type="text" name="cost_estimate" id="cost_estimate" value="{{ $room->price_per_night }}"
                                readonly class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('home') }}"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Book Room
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>