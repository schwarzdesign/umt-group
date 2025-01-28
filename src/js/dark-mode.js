document.addEventListener('alpine:init', () => {
  Alpine.data('darkMode', () => ({
    dark: false,
    init() {
      this.dark = localStorage.getItem('dark-mode') === 'enabled';
      if (this.dark) {
        document.documentElement.classList.add('dark');
      }
    },
    toggle() {
      this.dark = !this.dark;
      if (this.dark) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('dark-mode', 'enabled');
      } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('dark-mode', 'disabled');
      }
    }
  }));
});

document.addEventListener('DOMContentLoaded', () => {
  if (localStorage.getItem('dark-mode') === 'enabled') {
    document.documentElement.classList.add('dark');
  }
});
