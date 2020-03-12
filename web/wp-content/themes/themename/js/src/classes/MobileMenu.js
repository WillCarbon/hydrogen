const debounce = require('debounce');

class MobileMenu {
    constructor () {
        this.container = document.querySelector('.o-page-container');
        this.menu = document.querySelector('.c-nav-mobile');
        this.menuBtn = document.querySelector('.c-header__toggle');

        if (this.menu) {
            this.menuBtn.addEventListener('click', () => this.animateNav(), false);
        }
    }

    animateNav () {
        debounce(this.toggleNav(), 200)
    }

    toggleNav () {
        this.menu.classList.toggle('c-nav-mobile--nav-open');
        this.container.classList.toggle('o-page-container--nav-open');
    }
}

module.exports = new MobileMenu();
