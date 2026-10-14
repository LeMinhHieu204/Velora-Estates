<article class="property-card" data-property-card data-type="{{ strtolower($property['type']) }}" data-price="{{ (int) preg_replace('/[^0-9]/', '', $property['price']) }}" data-beds="{{ $property['beds'] }}" data-location="{{ strtolower($property['location']) }}">
    <div class="property-image-wrap">
        <a href="{{ route('properties.show', $property['slug']) }}" class="property-image-link" aria-label="View {{ $property['title'] }}">
            <img class="property-image" src="{{ $property['image'] }}" alt="{{ $property['title'] }} — illustrative demo photography" loading="lazy">
        </a>
        @if ($property['status']) <span class="card-badge">{{ strtoupper($property['status']) }}</span> @endif
        <button class="favorite-toggle" type="button" aria-label="Save {{ $property['title'] }}" data-favorite="{{ $property['slug'] }}"><span>♡</span></button>
    </div>
    <div class="property-card-body">
        <span class="card-location"><span class="pin">⌖</span> {{ strtoupper($property['location']) }}</span>
        <h3><a href="{{ route('properties.show', $property['slug']) }}">{{ $property['title'] }}</a></h3>
        <p class="card-price">{{ $property['price'] }}</p>
        <div class="property-meta"><span>{{ $property['beds'] }} Beds</span><i></i><span>{{ $property['baths'] }} Baths</span><i></i><span>{{ $property['area'] }} Sq Ft</span></div>
        @if ($showButton ?? false)
            <a class="text-link card-link" href="{{ route('properties.show', $property['slug']) }}">VIEW DETAILS <span>→</span></a>
        @endif
    </div>
</article>
