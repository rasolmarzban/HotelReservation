<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Hotels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button id="my-hotels-tab" class="border-indigo-500 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                My Registered Hotels
                            </button>
                            <button id="my-bookings-tab" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                My Bookings
                            </button>
                        </nav>
                    </div>

                    <!-- My Registered Hotels Tab Content -->
                    <div id="my-hotels-content" class="mt-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hotel Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($myHotels as $hotel)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $hotel->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $hotel->location }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($hotel->available_rooms_count > 0)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $hotel->available_rooms_count }} room{{ $hotel->available_rooms_count > 1 ? 's' : '' }} available
                                            </span>
                                            @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                No rooms available
                                            </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('hotels.edit', $hotel->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- My Bookings Tab Content -->
                    <div id="my-bookings-content" class="mt-6 hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hotel Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room Type</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($myBookings as $booking)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->hotel->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Room {{ $booking->room->room_number }} - {{ $booking->room->type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->check_in ? \Carbon\Carbon::parse($booking->check_in)->toDateString() : '' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->check_out ? \Carbon\Carbon::parse($booking->check_out)->toDateString() : '' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('bookings.show', $booking->id) }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const myHotelsTab = document.getElementById('my-hotels-tab');
            const myBookingsTab = document.getElementById('my-bookings-tab');
            const myHotelsContent = document.getElementById('my-hotels-content');
            const myBookingsContent = document.getElementById('my-bookings-content');

            function switchTab(activeTab, activeContent, inactiveTab, inactiveContent) {
                activeTab.classList.add('border-indigo-500', 'text-indigo-600');
                activeTab.classList.remove('border-transparent', 'text-gray-500');
                activeContent.classList.remove('hidden');

                inactiveTab.classList.remove('border-indigo-500', 'text-indigo-600');
                inactiveTab.classList.add('border-transparent', 'text-gray-500');
                inactiveContent.classList.add('hidden');
            }

            myHotelsTab.addEventListener('click', () => {
                switchTab(myHotelsTab, myHotelsContent, myBookingsTab, myBookingsContent);
            });

            myBookingsTab.addEventListener('click', () => {
                switchTab(myBookingsTab, myBookingsContent, myHotelsTab, myHotelsContent);
            });
        });
    </script>
    @endpush
</x-app-layout>