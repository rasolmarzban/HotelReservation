<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Carousel Test (Static) -->
            <div id="carouselExampleIndicators" class="carousel slide shadow-xl mb-6" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($hotel->images as $index => $image)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($hotel->images as $index => $image)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img class="d-block w-100" src="{{ asset('storage/' . $image->image_path) }}" alt="Slide {{ $index + 1 }}">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Hotel Specifications -->
                    <div class="bg-white shadow-xl sm:rounded-lg p-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Hotel Specifications</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="flex items-center space-x-2 gap-4">
                                <svg style="width: 35px;" class="text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Number of Rooms</p>
                                    <p class="font-medium">{{ $hotel->number_of_rooms }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 gap-4">
                                <svg style="width: 35px;" class="text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Number of Bathrooms</p>
                                    <p class="font-medium">{{ $hotel->number_of_bathrooms }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 gap-4">
                                <svg style="width: 35px;" class="text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Area</p>
                                    <p class="font-medium">{{ $hotel->area }} m2</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 gap-4">
                                <svg style="width: 35px;" class="text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Capacity</p>
                                    <p class="font-medium">{{ $hotel->capacity }} people</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 gap-4">
                                <svg style="width: 35px;" class="text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Price per Night</p>
                                    <p class="font-medium">${{ number_format($hotel->price_per_night) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 gap-4">
                                <svg style="width: 35px;" class="text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Rating</p>
                                    <p class="font-medium">{{ $hotel->rating }}/5</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Amenities -->
                    <div class="bg-white shadow-xl sm:rounded-lg p-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Amenities</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 md:gap-6">
                            @if($hotel->has_pool)
                            <div class="relative flex items-center space-x-2 gap-4">
                                <img src="{{ asset('images/swimming-pool.png') }}" alt="Swimming Pool" style="width: 35px; display: inline-block; vertical-align: middle;" />
                                <strong style="top: 10px;">Pool</strong>
                            </div>
                            @endif
                            @if($hotel->has_jacuzzi)
                            <div class="relative flex items-center space-x-2 gap-4">
                                <img src="{{ asset('images/jacuzzi.png') }}" alt="Swimming Pool" style="width: 35px; display: inline-block; vertical-align: middle;" />
                                <strong style="top: 10px;">Jacuzzi</strong>
                            </div>
                            @endif
                            @if($hotel->has_wifi)
                            <div class="relative flex items-center space-x-2 gap-4">
                                <img src="{{ asset('images/wifi-signal.png') }}" alt="Swimming Pool" style="width: 35px; display: inline-block; vertical-align: middle;" />
                                <strong style="top: 10px;">Wifi</strong>
                            </div>
                            @endif
                            @if($hotel->has_parking)
                            <div class="relative flex items-center space-x-2 gap-4">
                                <img src="{{ asset('images/parking-area.png') }}" alt="Swimming Pool" style="width: 35px; display: inline-block; vertical-align: middle;" />
                                <strong style="top: 10px;">Parking</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white shadow-xl sm:rounded-lg p-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Description</h2>
                        <p class="text-gray-600">{{ $hotel->description }}</p>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Contact Information -->
                    <div class="bg-white shadow-xl sm:rounded-lg p-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Contact Information</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Owner Name</p>
                                <p class="font-medium">{{ $hotel->owner_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Phone Number</p>
                                <p class="font-medium">{{ $hotel->owner_phone }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium">{{ $hotel->owner_email }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Address</p>
                                <p class="font-medium">{{ $hotel->address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <div class="bg-white shadow-xl sm:rounded-lg p-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Booking Form</h2>

                        @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                            <ul class="text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                            <p class="text-sm text-red-600">{{ session('error') }}</p>
                        </div>
                        @endif

                        @if (session('success'))
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md">
                            <p class="text-sm text-green-600">{{ session('success') }}</p>
                        </div>
                        @endif

                        <form action="{{ route('hotels.book', $hotel) }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

                            @if($hotel->rooms && $hotel->rooms->count() > 0)
                            <div>
                                <label for="room_id" class="block text-sm font-medium text-gray-700">Available Rooms</label>
                                <select name="room_id" id="room_id" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Select an Available Room --</option>
                                    @foreach($hotel->rooms as $room)
                                    <option value="{{ $room->id }}">
                                        Room {{ $room->room_number }} - {{ $room->type }} (Capacity: {{ $room->capacity }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                            <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
                                <p class="text-sm text-yellow-600">This hotel currently has no available rooms.</p>
                            </div>
                            @endif

                            <div class="mt-4">
                                <label for="check_in" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                                <input type="date" name="check_in" id="check_in" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="mt-4">
                                <label for="check_out" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                                <input type="date" name="check_out" id="check_out" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="mt-4">
                                <label for="guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                                <input type="number" name="guests" id="guests" min="1" max="{{ $hotel->capacity }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <button type="submit"
                                class="w-full mt-4 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Book Hotel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endpush