<header class="site-header" data-header>
    <div class="header-inner">
        <a class="brand" href="{{ route('home') }}" aria-label="Velora Estates home">
            <span class="brand-name">VELORA</span>
            <span class="brand-subtitle">ESTATES</span>
        </a>
        <nav class="primary-nav" aria-label="Primary navigation">
            <a class="{{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}" data-home-link>Home</a>
            <a class="{{ request()->routeIs('properties.*') ? 'is-active' : '' }}" href="{{ route('properties.index') }}">Properties</a>
            <a href="{{ route('home') }}#about" data-section-link="about">About</a>
            <a href="{{ route('home') }}#agents" data-section-link="agents">Agents</a>
            <a href="{{ route('home') }}#testimonials" data-section-link="testimonials">Testimonials</a>
            <a href="{{ route('home') }}#contact" data-section-link="contact">Contact</a>
        </nav>
        <button class="button header-cta" type="button" data-open-tour>SCHEDULE A PRIVATE TOUR <span>→</span></button>
        <button class="menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false" data-menu-toggle>
            <span></span><span></span>
        </button>
    </div>
    <div class="mobile-drawer" data-mobile-drawer aria-hidden="true">
        <div class="mobile-drawer-top">
            <span class="eyebrow">NAVIGATION</span>
            <button class="icon-button" type="button" aria-label="Close navigation" data-menu-close>×</button>
        </div>
        <nav aria-label="Mobile navigation">
            <a href="{{ route('home') }}">Home <span>↗</span></a>
            <a href="{{ route('properties.index') }}">Properties <span>↗</span></a>
            <a href="{{ route('home') }}#about" data-section-link="about">About <span>↗</span></a>
            <a href="{{ route('home') }}#agents" data-section-link="agents">Agents <span>↗</span></a>
            <a href="{{ route('home') }}#testimonials" data-section-link="testimonials">Testimonials <span>↗</span></a>
            <a href="{{ route('home') }}#contact" data-section-link="contact">Contact <span>↗</span></a>
        </nav>
        <button class="button button-gold drawer-cta" type="button" data-open-tour>SCHEDULE A PRIVATE TOUR <span>→</span></button>
    </div>
</header>
