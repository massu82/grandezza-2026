import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.store('notifications', {
        list: [],
        push({ type = 'info', message = '', timeout = 4200 } = {}) {
            if (!message) return;
            const id = Date.now() + Math.random();
            this.list.push({ id, type, message });
            if (timeout) {
                setTimeout(() => this.dismiss(id), timeout);
            }
        },
        dismiss(id) {
            this.list = this.list.filter((n) => n.id !== id);
        },
    });

    window.addEventListener('notify', (event) => {
        Alpine.store('notifications').push(event.detail || {});
    });

    Alpine.data('mainHeader', ({ links = [], cartCount = 0 } = {}) => ({
        open: false,
        scrolled: false,
        links,
        cartCount,
        toggle() { this.open = !this.open; },
        close() { this.open = false; },
        buttonClasses: 'p-2 rounded-md border border-zinc-200 text-zinc-600 focus:outline-none focus:ring-2 focus:ring-accent',
        init() {
            const onScroll = () => { this.scrolled = window.scrollY > 8; };
            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll();
            this.$watch('open', (val) => {
                if (!val) return;
                this.scrolled = true;
            });
        },
    }));

    Alpine.data('uiButton', ({ variant = 'primary' } = {}) => ({
        variant,
        classes() {
            const base = 'inline-flex items-center justify-center gap-2 font-semibold transition focus:outline-none focus:ring-2 focus:ring-offset-2';
            const variants = {
                primary: 'px-4 py-2 rounded-lg bg-gradient-to-r from-zinc-600 via-zinc-700 to-zinc-900 text-white hover:from-zinc-700 hover:to-zinc-700 focus:ring-zinc-300 focus:ring-offset-light',
                dark: 'px-3 py-2 rounded-full bg-black text-white hover:bg-primary focus:ring-zinc-300 focus:ring-offset-light',
                outline: 'px-4 py-2 rounded-lg border border-zinc-300 text-zinc-900 hover:border-primary hover:text-primary focus:ring-zinc-200 focus:ring-offset-white',
            };
            return `${base} ${variants[this.variant] || variants.primary}`;
        },
    }));

    Alpine.data('sectionTitle', ({ kicker = '', title = '', ctaUrl = '', ctaLabel = '' } = {}) => ({
        kicker,
        title,
        ctaUrl,
        ctaLabel,
    }));

    Alpine.data('formState', () => ({
        submitting: false,
        start(event) {
            if (this.submitting) {
                event?.preventDefault();
                return;
            }
            this.submitting = true;
        },
        reset() {
            this.submitting = false;
        },
    }));

    Alpine.data('categoryForm', ({ initialSlug = '', initialName = '' } = {}) => ({
        submitting: false,
        slug: initialSlug || '',
        slugEdited: false,
        start(event) {
            if (this.submitting) {
                event?.preventDefault();
                return;
            }
            this.submitting = true;
        },
        reset() {
            this.submitting = false;
        },
        onNameInput(event) {
            if (this.slugEdited) return;
            this.slug = this.slugify(event.target.value);
        },
        onSlugInput(event) {
            this.slugEdited = true;
            this.slug = this.slugify(event.target.value);
        },
        slugify(value) {
            return (value || '')
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '')
                .slice(0, 255);
        },
        init() {
            if (!this.slug && initialName) {
                this.slug = this.slugify(initialName);
            }
        },
    }));

    Alpine.data('presentationField', ({ initial = '' } = {}) => ({
        value: initial || '',
        unit: '',
        applyUnit() {
            const base = (this.value || '').replace(/\s+(ml|l|cl)$/i, '').trim();
            if (!this.unit) {
                this.value = base;
                return;
            }
            this.value = base ? `${base} ${this.unit}` : this.unit;
        },
    }));

    Alpine.data('filtersBar', ({ initial = {} } = {}) => ({
        filters: {
            tipo: initial.tipo || '',
            pais: initial.pais || '',
            categoria: initial.categoria || '',
            orden: initial.orden || '',
        },
        submit() {
            const params = new URLSearchParams();
            Object.entries(this.filters).forEach(([key, val]) => {
                if (val) params.set(key, val);
            });
            window.location = `${window.location.pathname}?${params.toString()}`;
        },
        clear() {
            this.filters = { tipo: '', pais: '', categoria: '', orden: '' };
            this.submit();
        },
    }));

    Alpine.data('toggleEstado', ({ id, initial = 0, presentation = '', precio = 0, stock = 0, token = '' } = {}) => ({
        id,
        current: Number(initial),
        presentation,
        precio,
        stock,
        token,
        loading: false,
        async toggle() {
            if (this.loading) return;
            this.loading = true;
            const next = this.current === 1 ? 0 : 1;
            try {
                const response = await fetch(`/admin/products/${this.id}/inline`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': this.token,
                    },
                    body: JSON.stringify({
                        presentation: this.presentation,
                        precio: this.precio,
                        stock: this.stock,
                        estado: next,
                    }),
                });
                if (response.ok) {
                    this.current = next;
                }
            } catch {
                // ignore error
            } finally {
                this.loading = false;
            }
        },
    }));

    Alpine.data('scrollToTop', ({ threshold = 240 } = {}) => ({
        visible: false,
        threshold,
        cleanup: null,
        init() {
            const handler = () => { this.visible = window.scrollY > this.threshold; };
            window.addEventListener('scroll', handler, { passive: true });
            handler();
            this.cleanup = () => window.removeEventListener('scroll', handler);
        },
        scroll() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        destroy() {
            this.cleanup?.();
        },
    }));
});

Alpine.start();
