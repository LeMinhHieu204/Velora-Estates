(function () {
    const qs = (selector, scope = document) => scope.querySelector(selector);
    const qsa = (selector, scope = document) => Array.from(scope.querySelectorAll(selector));

    const toast = (message) => {
        const node = qs('[data-toast]');
        if (!node) return;
        node.textContent = message;
        node.classList.add('is-visible');
        window.clearTimeout(window.veloraToastTimer);
        window.veloraToastTimer = window.setTimeout(() => node.classList.remove('is-visible'), 3600);
    };

    const header = qs('[data-header]');
    const updateHeader = () => header && header.classList.toggle('is-scrolled', window.scrollY > 16);
    window.addEventListener('scroll', updateHeader, { passive: true });
    updateHeader();

    const isHomePage = document.body.classList.contains('home-page');
    const sectionLinks = qsa('[data-section-link]');
    const homeSections = ['about', 'agents', 'testimonials', 'contact'].map((id) => document.getElementById(id)).filter(Boolean);
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const setActiveSection = (id) => {
        sectionLinks.forEach((link) => link.classList.toggle('is-active', link.dataset.sectionLink === id));
        qs('[data-home-link]')?.classList.toggle('is-active', !id);
    };
    const scrollToSection = (id, behavior = 'smooth') => {
        const section = document.getElementById(id);
        if (!section) return false;
        setActiveSection(id);
        section.scrollIntoView({ behavior: reducedMotion ? 'auto' : behavior, block: 'start' });
        return true;
    };
    const handleHash = (behavior = 'smooth') => {
        if (!isHomePage || !window.location.hash) return;
        const id = window.location.hash.slice(1);
        if (homeSections.some((section) => section.id === id)) window.setTimeout(() => scrollToSection(id, behavior), 30);
    };
    sectionLinks.forEach((link) => link.addEventListener('click', (event) => {
        if (!isHomePage) return;
        const target = new URL(link.href, window.location.href);
        if (target.pathname !== window.location.pathname) return;
        const id = link.dataset.sectionLink;
        event.preventDefault();
        if (window.location.hash !== `#${id}`) window.history.pushState({ section: id }, '', `#${id}`);
        scrollToSection(id);
    }));
    if (isHomePage) {
        const observer = new IntersectionObserver((entries) => {
            const visible = entries.filter((entry) => entry.isIntersecting).sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
            if (visible) setActiveSection(visible.target.id);
        }, { rootMargin: '-28% 0px -58% 0px', threshold: [0, .15, .4, .8] });
        homeSections.forEach((section) => observer.observe(section));
        handleHash('auto');
        window.addEventListener('hashchange', () => handleHash('smooth'));
        window.addEventListener('popstate', () => handleHash('smooth'));
    }

    const drawer = qs('[data-mobile-drawer]');
    const setDrawer = (open) => {
        if (!drawer) return;
        drawer.classList.toggle('is-open', open);
        drawer.setAttribute('aria-hidden', String(!open));
        const toggle = qs('[data-menu-toggle]');
        if (toggle) toggle.setAttribute('aria-expanded', String(open));
    };
    qs('[data-menu-toggle]')?.addEventListener('click', () => setDrawer(true));
    qs('[data-menu-close]')?.addEventListener('click', () => setDrawer(false));
    qsa('[data-mobile-drawer] a').forEach((link) => link.addEventListener('click', () => setDrawer(false)));

    qsa('[data-agent-context]').forEach((link) => link.addEventListener('click', () => {
        const setContext = () => {
            const inquiry = qs('[data-contact-form] select[name="inquiry_type"]');
            const message = qs('[data-contact-form] textarea[name="message"]');
            if (inquiry) inquiry.value = 'Speak with an advisor';
            if (message && !message.value) message.value = `I would like to speak with ${link.dataset.agentContext}.`;
        };
        window.setTimeout(setContext, isHomePage ? 60 : 500);
    }));

    const modal = qs('[data-tour-modal]');
    const setModal = (open) => {
        if (!modal) return;
        modal.classList.toggle('is-open', open);
        modal.setAttribute('aria-hidden', String(!open));
        document.body.classList.toggle('modal-open', open);
        if (open) window.setTimeout(() => qs('[data-tour-form] input')?.focus(), 50);
    };
    qsa('[data-open-tour]').forEach((button) => button.addEventListener('click', () => setModal(true)));
    qsa('[data-close-tour]').forEach((button) => button.addEventListener('click', () => setModal(false)));
    qs('[data-tour-form]')?.addEventListener('submit', (event) => {
        event.preventDefault();
        setModal(false);
        event.currentTarget.reset();
        toast('Thank you — your private tour request is ready for an advisor to review.');
    });
    qs('[data-inline-tour-form]')?.addEventListener('submit', (event) => {
        event.preventDefault();
        event.currentTarget.reset();
        toast('Thank you — an advisor will be in touch with you shortly.');
    });

    const testimonialSlides = qsa('[data-testimonial-slide]');
    if (testimonialSlides.length) {
        let testimonialIndex = 0;
        const renderTestimonial = (index) => {
            testimonialIndex = (index + testimonialSlides.length) % testimonialSlides.length;
            testimonialSlides.forEach((slide, i) => {
                const active = i === testimonialIndex;
                slide.classList.toggle('is-active', active);
                slide.setAttribute('aria-hidden', String(!active));
            });
            const current = qs('[data-testimonial-current]');
            if (current) current.textContent = String(testimonialIndex + 1).padStart(2, '0');
        };
        qs('[data-testimonial-prev]')?.addEventListener('click', () => renderTestimonial(testimonialIndex - 1));
        qs('[data-testimonial-next]')?.addEventListener('click', () => renderTestimonial(testimonialIndex + 1));
        qsa('[data-testimonial-prev], [data-testimonial-next]').forEach((button) => button.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft') { event.preventDefault(); renderTestimonial(testimonialIndex - 1); }
            if (event.key === 'ArrowRight') { event.preventDefault(); renderTestimonial(testimonialIndex + 1); }
        }));
        renderTestimonial(0);
    }

    const contactForm = qs('[data-contact-form]');
    if (contactForm) {
        const clearFieldError = (field) => {
            field.removeAttribute('aria-invalid');
            const error = qs(`[data-error-for="${field.name}"]`, contactForm);
            if (error) error.textContent = '';
        };
        qsa('input, select, textarea', contactForm).forEach((field) => field.addEventListener('input', () => clearFieldError(field)));
        contactForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const fields = ['full_name', 'email', 'inquiry_type', 'message'].map((name) => contactForm.elements[name]);
            let firstInvalid = null;
            fields.forEach((field) => {
                clearFieldError(field);
                let message = '';
                if (!field.value.trim()) message = 'This field is required.';
                if (field.name === 'email' && field.value.trim() && !/^\S+@\S+\.\S+$/.test(field.value.trim())) message = 'Enter a valid email address.';
                if (message) {
                    field.setAttribute('aria-invalid', 'true');
                    qs(`[data-error-for="${field.name}"]`, contactForm).textContent = message;
                    firstInvalid ||= field;
                }
            });
            const status = qs('[data-contact-status]');
            if (firstInvalid) { firstInvalid.focus(); if (status) status.classList.remove('is-visible'); return; }
            if (status) { status.textContent = 'Preview mode: your enquiry passed client-side validation, but nothing was stored or emailed.'; status.classList.add('is-visible'); }
            contactForm.reset();
        });
    }

    const favoriteKey = 'velora-preview-favorites';
    const getFavorites = () => {
        try { return JSON.parse(localStorage.getItem(favoriteKey) || '[]'); } catch (error) { return []; }
    };
    const saveFavorites = (items) => localStorage.setItem(favoriteKey, JSON.stringify(items));
    const paintFavorite = (button, saved) => {
        button.classList.toggle('is-saved', saved);
        if (button.classList.contains('favorite-toggle')) {
            const icon = qs('span', button);
            if (icon) icon.textContent = saved ? '♥' : '♡';
        } else {
            button.childNodes[0].textContent = saved ? '♥ ' : '♡ ';
        }
        button.setAttribute('aria-pressed', String(saved));
    };
    qsa('[data-favorite]').forEach((button) => {
        const slug = button.dataset.favorite;
        paintFavorite(button, getFavorites().includes(slug));
        button.addEventListener('click', () => {
            const favorites = getFavorites();
            const index = favorites.indexOf(slug);
            if (index === -1) favorites.push(slug); else favorites.splice(index, 1);
            saveFavorites(favorites);
            paintFavorite(button, index === -1);
            toast(index === -1 ? 'Property saved to your favorites.' : 'Property removed from your favorites.');
        });
    });

    qs('[data-search-form]')?.addEventListener('submit', (event) => {
        event.preventDefault();
        const form = event.currentTarget;
        const params = new URLSearchParams(new FormData(form));
        [...params].forEach(([key, value]) => { if (!value) params.delete(key); });
        window.location.href = `${form.action}?${params.toString()}`;
    });

    const filterForm = qs('[data-filter-form]');
    const cards = () => qsa('[data-property-card]');
    const getFormValue = (name) => {
        if (!filterForm) return '';
        const field = filterForm.elements[name];
        if (!field) return '';
        if (field instanceof RadioNodeList) return field.value;
        return field.value || '';
    };
    const applyFilters = (updateUrl = false) => {
        if (!filterForm) return;
        const locationValue = getFormValue('location').trim().toLowerCase();
        const typeValue = getFormValue('type').toLowerCase();
        const maxPrice = Number(getFormValue('max_price') || 25000000);
        const beds = Number(getFormValue('bedrooms') || 0);
        let visible = 0;
        cards().forEach((card) => {
            const matchesLocation = !locationValue || card.dataset.location.includes(locationValue);
            const matchesType = !typeValue || card.dataset.type === typeValue;
            const matchesPrice = !maxPrice || Number(card.dataset.price) <= maxPrice;
            const matchesBeds = !beds || Number(card.dataset.beds) >= beds;
            const show = matchesLocation && matchesType && matchesPrice && matchesBeds;
            card.hidden = !show;
            if (show) visible += 1;
        });
        const count = qs('[data-result-count]');
        if (count) count.textContent = visible;
        const empty = qs('[data-empty-state]');
        if (empty) empty.hidden = visible !== 0;
        const output = qs('[data-price-output]');
        if (output) output.textContent = maxPrice >= 25000000 ? '$25M+' : `$${Math.round(maxPrice / 1000000)}M`;
        if (updateUrl) {
            const params = new URLSearchParams();
            ['location', 'type', 'max_price', 'bedrooms'].forEach((name) => { const value = getFormValue(name); if (value) params.set(name, value); });
            window.history.replaceState({}, '', `${window.location.pathname}${params.toString() ? `?${params}` : ''}`);
        }
    };
    filterForm?.addEventListener('submit', (event) => { event.preventDefault(); applyFilters(true); toast('Your preview search has been updated.'); qs('[data-filter-panel]')?.classList.remove('is-open'); });
    qs('[data-clear-filters]')?.addEventListener('click', () => { filterForm.reset(); applyFilters(true); });
    qs('[data-price-range]')?.addEventListener('input', () => applyFilters(false));
    applyFilters(false);

    qs('[data-sort]')?.addEventListener('change', (event) => {
        const grid = qs('[data-catalog-grid]');
        if (!grid) return;
        const sorted = cards().sort((a, b) => {
            if (event.target.value === 'price-low') return Number(a.dataset.price) - Number(b.dataset.price);
            if (event.target.value === 'price-high') return Number(b.dataset.price) - Number(a.dataset.price);
            if (event.target.value === 'area') return Number(b.querySelector('.property-meta span:last-child')?.textContent.replace(/[^0-9]/g, '') || 0) - Number(a.querySelector('.property-meta span:last-child')?.textContent.replace(/[^0-9]/g, '') || 0);
            return 0;
        });
        sorted.forEach((card) => grid.appendChild(card));
        toast(`Sorted by ${event.target.options[event.target.selectedIndex].text.toLowerCase()}.`);
    });
    qs('[data-filter-open]')?.addEventListener('click', () => qs('[data-filter-panel]')?.classList.add('is-open'));
    qs('[data-filter-close]')?.addEventListener('click', () => qs('[data-filter-panel]')?.classList.remove('is-open'));

    const galleryMain = qs('[data-gallery-main]');
    const galleryThumbs = qsa('[data-gallery-thumb]');
    if (galleryMain && galleryThumbs.length) {
        let current = 0;
        const renderGallery = (index) => {
            current = (index + galleryThumbs.length) % galleryThumbs.length;
            const image = qs('img', galleryThumbs[current]);
            galleryMain.src = image.src;
            galleryMain.alt = image.alt;
            galleryThumbs.forEach((thumb, i) => thumb.classList.toggle('is-active', i === current));
            const counter = qs('[data-gallery-count]');
            if (counter) counter.textContent = `${current + 1} / ${galleryThumbs.length}`;
        };
        galleryThumbs.forEach((thumb, index) => thumb.addEventListener('click', () => renderGallery(index)));
        qs('[data-gallery-prev]')?.addEventListener('click', () => renderGallery(current - 1));
        qs('[data-gallery-next]')?.addEventListener('click', () => renderGallery(current + 1));
        const lightbox = qs('[data-lightbox]');
        const openLightbox = () => {
            if (!lightbox) return;
            const image = qs('[data-lightbox-image]');
            image.src = galleryMain.src; image.alt = galleryMain.alt;
            lightbox.classList.add('is-open'); lightbox.setAttribute('aria-hidden', 'false'); document.body.classList.add('modal-open');
        };
        qs('[data-gallery-fullscreen]')?.addEventListener('click', openLightbox);
        qs('[data-lightbox-close]')?.addEventListener('click', () => { lightbox.classList.remove('is-open'); lightbox.setAttribute('aria-hidden', 'true'); document.body.classList.remove('modal-open'); });
    }

    qs('[data-share]')?.addEventListener('click', async () => {
        const data = { title: document.title, text: 'Explore this extraordinary home at Velora Estates.', url: window.location.href };
        if (navigator.share) { try { await navigator.share(data); } catch (error) { /* dismissed */ } }
        else { await navigator.clipboard?.writeText(window.location.href); toast('Property link copied to your clipboard.'); }
    });
    qsa('[data-toast-button]').forEach((button) => button.addEventListener('click', () => toast(button.dataset.toastButton)));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') { setModal(false); setDrawer(false); qs('[data-lightbox-close]')?.click(); }
        if (galleryMain && (event.key === 'ArrowLeft' || event.key === 'ArrowRight')) { (event.key === 'ArrowLeft' ? qs('[data-gallery-prev]') : qs('[data-gallery-next]'))?.click(); }
    });
})();
