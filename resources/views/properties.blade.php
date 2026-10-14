@extends('layouts.velora', ['title' => 'Curated Global Properties — Velora Estates', 'bodyClass' => 'properties-page'])

@section('content')
    <section class="page-banner">
        <div class="page-banner-image"></div><div class="page-banner-overlay"></div>
        <div class="page-banner-content shell"><span class="eyebrow">EXCEPTIONAL HOMES, CURATED WORLDWIDE.</span><h1>Curated Global<br><em>Properties</em></h1><p>An exclusive collection of extraordinary homes in the world's most desirable destinations. Each property is hand-selected for its beauty, lifestyle and lasting value.</p></div>
    </section>
    <section class="catalog shell">
        <aside class="filter-panel" data-filter-panel>
            <div class="filter-title"><span class="eyebrow eyebrow-dark">FIND YOUR EXTRAORDINARY</span><h2>Refine Your Search</h2><button type="button" class="filter-close" data-filter-close>×</button></div>
            <form data-filter-form>
                <label class="filter-block"><span class="filter-label"><span>⌖</span> LOCATION</span><input name="location" value="{{ $activeFilters['location'] ?? '' }}" placeholder="City, Country or Region"></label>
                <fieldset class="filter-block"><legend class="filter-label"><span>⌂</span> PROPERTY TYPE</legend>@foreach (['' => 'All Types', 'villa' => 'Villa', 'penthouse' => 'Penthouse', 'residence' => 'Residence', 'estate' => 'Estate', 'chalet' => 'Chalet'] as $value => $label)<label class="check-option"><input type="radio" name="type" value="{{ $value }}" {{ ($activeFilters['type'] ?? '') === $value ? 'checked' : '' }}><span>{{ $label }}</span></label>@endforeach</fieldset>
                <fieldset class="filter-block"><legend class="filter-label"><span>◇</span> PRICE RANGE</legend><div class="price-range"><input type="range" min="5000000" max="25000000" step="500000" value="{{ $activeFilters['max_price'] ?? '25000000' }}" name="max_price" data-price-range><div><span>$5M</span><output data-price-output>$25M+</output></div></div></fieldset>
                <fieldset class="filter-block"><legend class="filter-label"><span>▱</span> BEDROOMS</legend>@foreach (['' => 'Any', '2' => '2+', '3' => '3+', '4' => '4+', '5' => '5+'] as $value => $label)<label class="check-option"><input type="radio" name="bedrooms" value="{{ $value }}" {{ ($activeFilters['bedrooms'] ?? '') === $value ? 'checked' : '' }}><span>{{ $label }}</span></label>@endforeach</fieldset>
                <fieldset class="filter-block amenities"><legend class="filter-label"><span>⚙</span> AMENITIES</legend>@foreach (['Pool', 'Ocean View', 'Smart Home', 'Private Terrace', 'Wine Cellar', 'Gym', 'Guest House', '24/7 Security'] as $amenity)<label class="check-option"><input type="checkbox" name="amenities[]" value="{{ str($amenity)->slug() }}"><span>{{ $amenity }}</span></label>@endforeach</fieldset>
                <button class="button button-gold filter-submit" type="submit">APPLY FILTERS</button><button class="clear-filters" type="button" data-clear-filters>CLEAR ALL FILTERS</button>
            </form>
        </aside>
        <div class="catalog-results">
            <div class="catalog-toolbar"><div><span class="eyebrow eyebrow-dark">A COLLECTION WITHOUT COMPROMISE</span><h2><span data-result-count>{{ count($properties) }}</span> Properties</h2></div><div class="toolbar-actions"><label>Sort by <select data-sort><option value="featured">Featured</option><option value="newest">Newest</option><option value="price-low">Price: Low to High</option><option value="price-high">Price: High to Low</option><option value="area">Area</option></select></label><button type="button" class="view-toggle is-active" aria-label="Grid view">▦</button><button type="button" class="view-toggle" aria-label="List view">☷</button></div><button class="button filter-mobile-trigger" type="button" data-filter-open>FILTERS <span>＋</span></button></div>
            <div class="catalog-grid" data-catalog-grid>@foreach ($properties as $property) @include('components.property-card', ['property' => $property, 'showButton' => true]) @endforeach</div>
            <div class="empty-state" data-empty-state hidden><h3>No properties match this preview search.</h3><p>Try widening your location, price or bedroom filters.</p></div>
            <nav class="pagination" aria-label="Pagination"><button type="button" aria-label="Previous page">←</button><button type="button" class="is-active">1</button><button type="button">2</button><button type="button">3</button><button type="button" aria-label="Next page">→</button></nav>
        </div>
    </section>
    <section class="trust-strip"><div class="shell trust-inner"><div><strong>Trusted Worldwide</strong><span>A GLOBAL COLLECTION. A HIGHER STANDARD.</span></div><div><b>250<sup>+</sup></b><span>EXCLUSIVE PROPERTIES</span></div><div><b>35<sup>+</sup></b><span>COUNTRIES WORLDWIDE</span></div><div><b>$4.2B<sup>+</sup></b><span>IN GLOBAL SALES</span></div><div><b>98%</b><span>CLIENT SATISFACTION</span></div></div></section>
@endsection
