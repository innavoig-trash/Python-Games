import './bootstrap';
import './lucide';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.data('theme', () => ({
    mode: null,
    init() {
        this.mode = this.local();
        localStorage.setItem('mode', this.mode);

        Alpine.effect(() => {
            document.documentElement.classList.remove('dark', 'light');
            document.documentElement.classList.add(this.mode);
        });
    },
    local() {
        const dark = localStorage.getItem('mode') === 'dark';
        const system = localStorage.getItem('mode') === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches;
        return dark || system ? 'dark' : 'light';
    },
    toggle() {
        this.mode = this.mode === 'dark' ? 'light' : 'dark';
        localStorage.setItem('mode', this.mode);
    },
    watch() {
        if (this.mode === 'system') {
            this.mode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            localStorage.setItem('mode', this.mode);
        }
    }
}));

Alpine.start();
