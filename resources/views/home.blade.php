<x-app-layout>
    <div class="container p-6 mx-auto">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3 lg:grid-cols-4">
            @foreach($hotels as $hotel)
            <div class="p-6 bg-white rounded-lg shadow">
                @if($hotel->images && count($hotel->images) > 0)
                <div id="carouselHome{{ $hotel->id }}" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($hotel->images as $index => $image)
                        <li data-target="#carouselHome{{ $hotel->id }}" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($hotel->images as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img class="d-block w-100" src="{{ asset('storage/' . $image->image_path) }}" alt="Slide {{ $index + 1 }}">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselHome{{ $hotel->id }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselHome{{ $hotel->id }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                @else
                <img src="{{ $hotel->image_path }}" alt="{{ $hotel->name }}" class="object-cover w-full h-40 mb-4 rounded-md">
                @endif
                <a href="{{ route('hotels.show', $hotel->id) }}" class="block mb-2">
                    <h2 class="mb-2 text-2xl font-bold text-blue-600 hover:text-blue-800">{{ $hotel->name }}</h2>
                </a>
                <span>{{ $hotel->city_relation->name ?? 'N/A' }}</span>
                <div class="flex items-center mt-2">
                    <span class="mr-2 text-gray-600">Rating:</span>
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <=round($hotel->rating))
                            <svg class="w-5 h-5 text-yellow-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                            </svg>
                            @else
                            <svg class="w-5 h-5 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                            </svg>
                            @endif
                            @endfor
                    </div>
                </div>
                <span>price: ${{ $hotel->price_per_night ?? 'N/A' }}</span>
                <div class="flex mt-4 space-x-4">
                    <a href="{{ route('hotels.show', $hotel) }}"
                        class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150'>
                        View Details
                    </a>
                    @auth
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>