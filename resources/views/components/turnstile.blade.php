@props(['sitekey' => env('TURNSTILE_SITE_KEY', 'YOUR_TURNSTILE_SITE_KEY')])

<div class="cf-turnstile" data-sitekey="{{ $sitekey }}"></div>
@once
    @push('scripts')
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endpush
@endonce
