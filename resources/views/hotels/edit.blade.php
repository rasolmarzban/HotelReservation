<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900">Edit Hotel</h2>
                    </div>

                    @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                        <ul class="text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('hotels.update', $hotel) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Hotel Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Hotel Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $hotel->name) }}" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" id="location" value="{{ old('location', $hotel->location) }}" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Country Dropdown -->
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                <select name="country" id="country" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country', $hotel->country) == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Province Dropdown -->
                            <div>
                                <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                                <select name="province" id="province" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Select Province</option>
                                    @foreach($provinces as $province)
                                    <option value="{{ $province->id }}" {{ old('province', $hotel->province) == $province->id ? 'selected' : '' }}>
                                        {{ $province->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- City Dropdown -->
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <select name="city" id="city" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city', $hotel->city) == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" name="address" id="address" value="{{ old('address', $hotel->address) }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <!-- Hotel Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Number of Rooms -->
                            <div>
                                <label for="number_of_rooms" class="block text-sm font-medium text-gray-700">Number of Rooms</label>
                                <input type="number" name="number_of_rooms" id="number_of_rooms" min="0" value="{{ old('number_of_rooms', $hotel->number_of_rooms) }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Rooms Section -->
                            <div class="col-span-2">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Manage Rooms</h3>
                                <div id="rooms-container" data-room-count="{{ count($hotel->rooms) }}">
                                    @foreach($hotel->rooms as $index => $room)
                                    <div class="room-entry space-y-4 mb-4 p-4 border rounded">
                                        <input type="hidden" name="rooms[{{ $index }}][id]" value="{{ $room->id }}">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Room Number</label>
                                            <input type="text" name="rooms[{{ $index }}][room_number]" value="{{ $room->room_number }}" required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Type</label>
                                            <select name="rooms[{{ $index }}][type]" required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                <option value="Standard" {{ $room->type === 'Standard' ? 'selected' : '' }}>Standard</option>
                                                <option value="Deluxe" {{ $room->type === 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                                                <option value="Suite" {{ $room->type === 'Suite' ? 'selected' : '' }}>Suite</option>
                                                <option value="Executive" {{ $room->type === 'Executive' ? 'selected' : '' }}>Executive</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Floor</label>
                                            <input type="number" name="rooms[{{ $index }}][floor]" value="{{ $room->floor }}" min="1" required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Capacity</label>
                                            <input type="number" name="rooms[{{ $index }}][capacity]" value="{{ $room->capacity }}" min="1" required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                        <div class="flex justify-end mt-2">
                                            <button type="button" onclick="this.parentElement.parentElement.remove()"
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                Remove Room
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addRoom()"
                                    class="mt-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Add Another Room
                                </button>
                            </div>

                            <!-- Number of Bathrooms -->
                            <div>
                                <label for="number_of_bathrooms" class="block text-sm font-medium text-gray-700">Number of Bathrooms</label>
                                <input type="number" name="number_of_bathrooms" id="number_of_bathrooms" min="0" value="{{ old('number_of_bathrooms', $hotel->number_of_bathrooms) }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Area -->
                            <div>
                                <label for="area" class="block text-sm font-medium text-gray-700">Area</label>
                                <input type="number" name="area" id="area" min="0" step="0.01" value="{{ old('area', $hotel->area) }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Capacity -->
                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity (people)</label>
                                <input type="number" name="capacity" id="capacity" min="0" value="{{ old('capacity', $hotel->capacity) }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Price per Night -->
                            <div>
                                <label for="price_per_night" class="block text-sm font-medium text-gray-700">Price per Night</label>
                                <input type="number" name="price_per_night" id="price_per_night" min="0" value="{{ old('price_per_night', $hotel->price_per_night) }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Rating -->
                            <div>
                                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                                <input type="number" name="rating" id="rating" min="0" max="5" step="0.1" value="{{ old('rating', $hotel->rating) }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <!-- Amenities -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Amenities</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="has_pool" id="has_pool" value="1" {{ old('has_pool', $hotel->has_pool) ? 'checked' : '' }}
                                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <label for="has_pool" class="ml-2 text-sm text-gray-700">Swimming Pool</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="has_jacuzzi" id="has_jacuzzi" value="1" {{ old('has_jacuzzi', $hotel->has_jacuzzi) ? 'checked' : '' }}
                                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <label for="has_jacuzzi" class="ml-2 text-sm text-gray-700">Jacuzzi</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="has_wifi" id="has_wifi" value="1" {{ old('has_wifi', $hotel->has_wifi) ? 'checked' : '' }}
                                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <label for="has_wifi" class="ml-2 text-sm text-gray-700">WiFi</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="has_parking" id="has_parking" value="1" {{ old('has_parking', $hotel->has_parking) ? 'checked' : '' }}
                                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <label for="has_parking" class="ml-2 text-sm text-gray-700">Parking</label>
                                </div>
                            </div>
                        </div>

                        <!-- Owner Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="owner_name" class="block text-sm font-medium text-gray-700">Owner Name</label>
                                <input type="text" name="owner_name" id="owner_name" value="{{ old('owner_name', $hotel->owner_name) }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="owner_phone" class="block text-sm font-medium text-gray-700">Owner Phone</label>
                                <input type="text" name="owner_phone" id="owner_phone" value="{{ old('owner_phone', $hotel->owner_phone) }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="owner_email" class="block text-sm font-medium text-gray-700">Owner Email</label>
                                <input type="email" name="owner_email" id="owner_email" value="{{ old('owner_email', $hotel->owner_email) }}"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $hotel->description) }}</textarea>
                        </div>

                        <!-- Current Images -->
                        @if($hotel->images->count() > 0)
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Current Images</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($hotel->images as $image)
                                <div class="relative">
                                    <img src="{{ Storage::url($image->image_path) }}" alt="Hotel image" class="w-full h-32 object-cover rounded-lg">
                                    @if($image->is_primary)
                                    <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold text-white bg-indigo-600 rounded-full">Primary</span>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- New Images -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Add New Images</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="images" class="block text-sm font-medium text-gray-700">Upload Images</label>
                                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <p class="mt-1 text-sm text-gray-500">You can select multiple images. The first image will be set as the primary image.</p>
                                </div>
                                <div id="image-preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Hotel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('images').addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';

            [...e.target.files].forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg">
                    `;
                    preview.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        });

        // Initialize room count
        let roomCount = parseInt(document.getElementById('rooms-container').dataset.roomCount);

        // Simple function to add a new room
        function addRoom() {
            const container = document.getElementById('rooms-container');
            const newRoom = document.createElement('div');
            newRoom.className = 'room-entry space-y-4 mb-4 p-4 border rounded';
            newRoom.innerHTML = `
                <div>
                    <label class="block text-sm font-medium text-gray-700">Room Number</label>
                    <input type="text" name="rooms[${roomCount}][room_number]" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="rooms[${roomCount}][type]" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="Standard">Standard</option>
                        <option value="Deluxe">Deluxe</option>
                        <option value="Suite">Suite</option>
                        <option value="Executive">Executive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Floor</label>
                    <input type="number" name="rooms[${roomCount}][floor]" min="1" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Capacity</label>
                    <input type="number" name="rooms[${roomCount}][capacity]" min="1" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="flex justify-end mt-2">
                    <button type="button" onclick="this.parentElement.parentElement.remove()"
                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Remove Room
                    </button>
                </div>
            `;
            container.appendChild(newRoom);
            roomCount++;
        }
    </script>
</x-app-layout>