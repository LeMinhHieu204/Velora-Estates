@extends('layouts.velora', ['title' => 'Velora Estates — Exceptional Homes. Remarkable Lives.', 'bodyClass' => 'home-page'])

@section('content')
    <section class="hero hero-home">
        <div class="hero-image" role="img" aria-label="Contemporary villa overlooking the sea at sunset"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content shell">
            <div class="hero-copy">
                <span class="eyebrow">GLOBAL PROPERTIES. A MORE EXTRAORDINARY YOU.</span>
                <h1>Discover<br><em>Extraordinary</em><br>Living</h1>
                <p>Exceptional homes. Remarkable lives. VELORA ESTATES connects you to the world's most exclusive properties in the most coveted destinations.</p>
                <button class="button button-gold" type="button" data-open-tour>SCHEDULE A PRIVATE TOUR <span>→</span></button>
            </div>
            <div class="hero-aside">
                <span class="eyebrow">EXCLUSIVE PROPERTIES<br>EXTRAORDINARY PEOPLE<br>A MORE BEAUTIFUL WORLD</span>
                <span class="hero-aside-rule"></span>
            </div>
            <div class="hero-location"><span>⌖</span> CÔTE D’AZUR, FRANCE</div>
        </div>
        <form class="search-panel shell" action="{{ route('properties.index') }}" method="get" data-search-form>
            <label class="search-field"><span class="field-label"><span class="field-icon">⌖</span> LOCATION</span><input name="location" placeholder="City, Country or Region"><span class="select-chevron">⌄</span></label>
            <label class="search-field"><span class="field-label"><span class="field-icon">⌂</span> PROPERTY TYPE</span><select name="type"><option value="">Any Type</option><option value="villa">Villa</option><option value="penthouse">Penthouse</option><option value="estate">Estate</option></select></label>
            <label class="search-field"><span class="field-label"><span class="field-icon">◇</span> PRICE RANGE</span><select name="max_price"><option value="">Any Price</option><option value="10000000">Up to $10M</option><option value="15000000">Up to $15M</option><option value="20000000">Up to $20M</option></select></label>
            <label class="search-field"><span class="field-label"><span class="field-icon">▱</span> BEDROOMS</span><select name="bedrooms"><option value="">Any</option><option value="3">3+</option><option value="4">4+</option><option value="5">5+</option></select></label>
            <button class="button button-gold search-submit" type="submit">SEARCH PROPERTIES <span>→</span></button>
        </form>
    </section>

    <section class="section featured-section shell">
        <div class="section-heading-row">
            <div><span class="eyebrow eyebrow-dark">EXCEPTIONAL HOMES, CURATED WORLDWIDE.</span><h2>Featured Properties</h2></div>
            <a class="text-link" href="{{ route('properties.index') }}">VIEW ALL PROPERTIES <span>→</span></a>
        </div>
        <div class="featured-layout">
            <div class="featured-grid">
                @foreach ($featured as $property)
                    @include('components.property-card', ['property' => $property])
                @endforeach
            </div>
            <aside class="stats-panel">
                <div><strong>250<sup>+</sup></strong><span>EXCLUSIVE PROPERTIES</span></div>
                <div><strong>35<sup>+</sup></strong><span>COUNTRIES WORLDWIDE</span></div>
                <div><strong>$4.2B<sup>+</sup></strong><span>IN GLOBAL SALES</span></div>
                <div><strong>98%</strong><span>CLIENT SATISFACTION</span></div>
            </aside>
            <a class="collection-card" href="{{ route('properties.index') }}">
                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=85" alt="Coastal terrace at golden hour — illustrative demo photography" loading="lazy">
                <span class="collection-shade"></span><span class="collection-label">EXPLORE CITIES</span>
                <div><h3>A Global<br>Collection</h3><p>From coastal retreats to city penthouses, explore a curated collection of the world's most extraordinary homes.</p><span class="text-link text-link-light">EXPLORE COLLECTION <span>→</span></span></div>
            </a>
        </div>
    </section>

    <section class="life-band" id="about">
        <div class="life-image life-image-main"><img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1600&q=85" alt="Warm modern interior opening to the sea — illustrative demo photography" loading="lazy"><div class="life-image-shade"></div><div class="life-band-copy"><h2>More Than Properties.<br><em>A Way of Life.</em></h2><p>Exclusive access. Unmatched experiences. A global network that opens the door to a more extraordinary you.</p><a class="text-link text-link-light" href="#service">LEARN ABOUT OUR APPROACH <span>→</span></a></div></div>
        <div class="service-copy" id="service"><span class="eyebrow eyebrow-dark">A MORE PERSONAL WAY TO BUY</span><h2>Personalized Service<br><em>for a Global Lifestyle</em></h2><p>Whether you're seeking a serene coastal retreat, a vibrant city residence, or a strategic investment, our team delivers a tailored experience defined by discretion, expertise, and unparalleled access.</p><ul class="check-list"><li>Private consultations</li><li>Exclusive off-market opportunities</li><li>End-to-end support</li><li>A global network of trusted advisors</li></ul></div>
        <div class="life-image life-image-side"><img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1100&q=85" alt="Sunlit landscape at the edge of a luxury home — illustrative demo photography" loading="lazy"><div class="life-image-shade"></div><h3>Extraordinary<br><em>Places.</em><br>Exceptional<br><em>People.</em></h3></div>
    </section>

    <section class="section agents-section shell" id="agents">
        <div class="section-heading-row"><div><span class="eyebrow eyebrow-dark">A GLOBAL TEAM. A LOCAL ADVANTAGE.</span><h2>Our Agents</h2></div><a class="text-link" href="#contact">START A CONVERSATION <span>→</span></a></div>
        <div class="agents-grid">
            <article class="agent-card"><img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=500&q=85" alt="Illustrative demo agent portrait for Alexander Grant" loading="lazy"><div><span class="demo-label">DEMO PROFILE</span><h3>Alexander Grant</h3><span>GLOBAL REAL ESTATE ADVISOR</span><p>New York <i>·</i> London <i>·</i> Dubai</p><small>Guides private clients toward distinctive homes and quiet opportunities across three global gateways.</small><a class="agent-contact-link" href="#contact" data-section-link="contact" data-agent-context="Alexander Grant">CONTACT ALEXANDER <span>→</span></a></div></article>
            <article class="agent-card"><img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=500&q=85" alt="Illustrative demo agent portrait for Sophie Laurent" loading="lazy"><div><span class="demo-label">DEMO PROFILE</span><h3>Sophie Laurent</h3><span>LUXURY PROPERTY SPECIALIST</span><p>Paris <i>·</i> Monaco <i>·</i> Nice</p><small>Brings a considered eye to Mediterranean residences, legacy estates and modern coastal living.</small><a class="agent-contact-link" href="#contact" data-section-link="contact" data-agent-context="Sophie Laurent">CONTACT SOPHIE <span>→</span></a></div></article>
            <article class="agent-card"><img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=500&q=85" alt="Illustrative demo agent portrait for Marco Vitale" loading="lazy"><div><span class="demo-label">DEMO PROFILE</span><h3>Marco Vitale</h3><span>INTERNATIONAL ESTATES DIRECTOR</span><p>Milan <i>·</i> Rome <i>·</i> St. Tropez</p><small>Connects discerning buyers with architecture-led homes and discreet expertise in Italy and France.</small><a class="agent-contact-link" href="#contact" data-section-link="contact" data-agent-context="Marco Vitale">CONTACT MARCO <span>→</span></a></div></article>
        </div>
    </section>

    <section class="testimonial-section shell" id="testimonials">
        <div class="testimonial-intro"><span class="eyebrow eyebrow-dark">EXTRAORDINARY PEOPLE. EXCEPTIONAL EXPERIENCES.</span><h2>What Our Clients Say</h2><p>Illustrative development examples shown for layout review. Verified testimonials will be added once approved.</p></div>
        <div class="testimonial-carousel" data-testimonial-carousel role="region" aria-roledescription="carousel" aria-label="Demo testimonials">
            <div class="testimonial-card testimonial-slide is-active" data-testimonial-slide><span class="demo-label">DEMO EXAMPLE · NOT A VERIFIED REVIEW</span><div class="quote-mark">“</div><blockquote>VELORA ESTATES made our dream of a Mediterranean home a reality. Their professional vision, global reach, and personalized service were truly exceptional.</blockquote><div class="testimonial-author"><span class="author-avatar">E</span><div><strong>Emma & James Carter</strong><span>London, UK</span></div></div></div>
            <div class="testimonial-card testimonial-slide" data-testimonial-slide><span class="demo-label">DEMO EXAMPLE · NOT A VERIFIED REVIEW</span><div class="quote-mark">“</div><blockquote>The process felt deeply personal from the first conversation. Every recommendation reflected the life we wanted to build, not just the home we thought we needed.</blockquote><div class="testimonial-author"><span class="author-avatar">M</span><div><strong>Michael R.</strong><span>New York, USA</span></div></div></div>
            <div class="testimonial-card testimonial-slide" data-testimonial-slide><span class="demo-label">DEMO EXAMPLE · NOT A VERIFIED REVIEW</span><div class="quote-mark">“</div><blockquote>Thoughtful, discreet and beautifully informed. The Velora team gave us the confidence to look beyond the obvious and find something truly rare.</blockquote><div class="testimonial-author"><span class="author-avatar">L</span><div><strong>Lucia B.</strong><span>Milan, Italy</span></div></div></div>
            <div class="testimonial-controls"><button type="button" data-testimonial-prev aria-label="Previous testimonial">←</button><span><b data-testimonial-current>01</b> / <span data-testimonial-total>03</span></span><button type="button" data-testimonial-next aria-label="Next testimonial">→</button></div>
        </div>
    </section>

    <section class="contact-section" id="contact">
        <div class="shell contact-grid">
            <div class="contact-story"><div class="contact-image"><img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1500&q=85" alt="Cinematic modern villa exterior at dusk — illustrative demo photography" loading="lazy"><span class="contact-image-caption">A MORE BEAUTIFUL WORLD</span></div><div class="contact-story-copy"><span class="eyebrow eyebrow-dark">PRIVATE CLIENT SERVICE</span><h2>Begin Your<br><em>Extraordinary Journey</em></h2><p>Let us help you find your next exceptional home. Share what you are looking for and our advisory team will shape the next conversation around your life, your location and your ambitions.</p><div class="contact-config"><span class="contact-config-label">DEMO PREVIEW · CONTACT DETAILS PENDING VERIFICATION</span><strong>Business contact information will be configured before production.</strong><span>No operational phone number, address or email is published in this preview.</span></div></div></div>
            <div class="contact-form-wrap"><span class="eyebrow eyebrow-dark">TELL US WHAT EXTRAORDINARY MEANS TO YOU</span><h3>Make an enquiry</h3><p class="form-intro">A few considered details help us make your first conversation more useful.</p><form class="contact-form" data-contact-form data-persist="true" method="POST" action="{{ route('inquiries.store') }}" novalidate>@csrf<div class="contact-form-grid"><label class="contact-field">Full name *<input name="full_name" autocomplete="name" required><span class="field-error" data-error-for="full_name"></span></label><label class="contact-field">Email address *<input type="email" name="email" autocomplete="email" required><span class="field-error" data-error-for="email"></span></label></div><div class="contact-form-grid"><label class="contact-field">Phone number<input name="phone" autocomplete="tel"><span class="field-error" data-error-for="phone"></span></label><label class="contact-field">Inquiry type *<select name="inquiry_type" required><option value="">Select an enquiry</option><option>Find a property</option><option>Sell a property</option><option>Speak with an advisor</option><option>Private tour</option></select><span class="field-error" data-error-for="inquiry_type"></span></label></div><label class="contact-field">Preferred location<input name="location" placeholder="City, country or region"></label><label class="contact-field">Message *<textarea name="message" rows="5" required placeholder="Tell us about the places, spaces or experiences you are considering."></textarea><span class="field-error" data-error-for="message"></span></label><button class="button button-gold" type="submit">SEND YOUR ENQUIRY <span>→</span></button><p class="form-status" data-contact-status role="status" aria-live="polite">{{ session('inquiry_success') }}</p><small class="form-note">Your enquiry is stored securely for an advisor to review. No appointment is confirmed by this form.</small></form></div>
        </div>
    </section>
@endsection
