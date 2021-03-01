const debounce = require('debounce');

class Navigation {
    constructor () {
        this.mobMenuClass   = 'js-nav-open';
        this.subMenuClass   = 'js-subnav-open';

        this.container      = document.querySelector('html');
        this.mobMenuBtn     = document.querySelector('.js-nav-toggle');
        this.subMenuBtn     = document.querySelectorAll('.c-navigation__sub-trigger, .c-navigation__item--parent > a');

        if (this.mobMenuBtn) {
            this.mobMenuBtn.addEventListener('click', (event) => this.animateMenu(event), false);
        }

        if (this.subMenuBtn.length > 0) {
            for (let i = 0; i < this.subMenuBtn.length; i++) {
                this.subMenuBtn[i].addEventListener('click', (event) => this.animateSubMenu(event), false);
            }
        }
    }

    animateMenu (event) {
        debounce(this.toggleMenu(event), 200)
    }

    animateSubMenu (event) {
        debounce(this.toggleSubMenu(event), 200)
    }

    toggleMenu (event) {
        event.preventDefault();
        this.container.classList.toggle(this.mobMenuClass);
        window.scrollTo(0, 0);
    }

    toggleSubMenu (event) {
        event.preventDefault();
        let parent = event.target.parentElement;

        if (parent.classList.contains(this.subMenuClass)) {
            parent.classList.remove(this.subMenuClass);
        } else {
            for (let i = 0; i < this.subMenuBtn.length; i++) {
                this.subMenuBtn[i].parentElement.classList.remove(this.subMenuClass);
            }
            parent.classList.add(this.subMenuClass);
        }
    }
}

module.exports = new Navigation();
