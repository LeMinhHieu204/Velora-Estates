<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1b1a18">
    <meta name="description" content="Velora Estates — exceptional homes, remarkable lives, curated worldwide.">
    <title>{{ $title ?? 'Velora Estates — Exceptional Homes. Remarkable Lives.' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Manrope:wght@400;500;600&family=Playfair+Display:ital,wght@0,500;0,600;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/velora.css') }}">
</head>
<body class="{{ $bodyClass ?? '' }}">
    <a class="skip-link" href="#main-content">Skip to content</a>
    @include('components.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('components.footer')
    <div class="toast" role="status" aria-live="polite" data-toast></div>
    <div class="tour-modal" data-tour-modal aria-hidden="true">
        <div class="tour-backdrop" data-close-tour></div>
        <section class="tour-dialog" role="dialog" aria-modal="true" aria-labelledby="tour-title">
            <button class="icon-button modal-close" type="button" aria-label="Close tour request" data-close-tour>×</button>
            <span class="eyebrow eyebrow-dark">PRIVATE CLIENT SERVICE</span>
            <h2 id="tour-title">Arrange a private tour.</h2>
            <p>Tell us how you would like to experience this home. A member of our advisory team will respond personally.</p>
            <form class="tour-form" data-tour-form>
                <div class="form-grid">
                    <label>Full name <input name="name" required placeholder="Your name"></label>
                    <label>Email address <input type="email" name="email" required placeholder="you@example.com"></label>
                </div>
                <div class="form-grid">
                    <label>Preferred date <input type="date" name="date"></label>
                    <label>Preferred time <select name="time"><option>Morning</option><option>Afternoon</option><option>Early evening</option></select></label>
                </div>
                <label>Message <textarea name="message" rows="3" placeholder="Tell us a little about what you are looking for."></textarea></label>
                <button class="button button-gold" type="submit">REQUEST A PRIVATE TOUR <span>→</span></button>
                <small>Your request is a preview interaction. No appointment is confirmed.</small>
            </form>
        </section>
    </div>
    <script src="{{ asset('js/velora.js') }}" defer></script>
</body>
</html>
