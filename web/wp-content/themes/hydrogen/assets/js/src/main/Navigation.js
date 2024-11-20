class Navigation {
    constructor() {
        this.mobMenuClass   = 'js-nav-open';
        this.subMenuClass   = 'is-open';

        this.container      = document.querySelector( 'html' );
        this.mobMenuBtn     = document.querySelector( '.js-nav-toggle' );
        this.subMenuBtn     = document.querySelectorAll( '.c-navigation__sub-trigger, .c-navigation__item--parent > a' );

        if ( this.mobMenuBtn ) {
            this.mobMenuBtn.addEventListener( 'click', ( event ) => this.toggleMenu( event ), false );
        }

        if ( this.subMenuBtn.length > 0 ) {
            for ( let i = 0; i < this.subMenuBtn.length; i++ ) {
                this.subMenuBtn[ i ].addEventListener( 'click', ( event ) => this.toggleSubMenu( event ), false );
            }
        }
    }

    toggleMenu( event ) {
        event.preventDefault();
        this.container.classList.toggle( this.mobMenuClass );
        window.scrollTo( 0, 0 );
    }

    toggleSubMenu( event ) {
        event.preventDefault();
        const parent = event.target.parentElement;

        if ( parent.classList.contains( this.subMenuClass ) ) {
            this.closeSubMenu(parent);
        } else {
            let subParent;
            for ( let i = 0; i < this.subMenuBtn.length; i++ ) {
                subParent = this.subMenuBtn[ i ].parentElement;
                this.closeSubMenu(subParent);
            }
            this.openSubMenu(parent);
        }
    }

    openSubMenu (parent) {
        const link = parent.querySelector('a');
        const button = parent.querySelector('button');

        parent.classList.add( this.subMenuClass );
        link.ariaExpanded = 'true';

        if (button) {
            button.textContent = button.dataset.close;
        }
    }

    closeSubMenu (parent) {
        const link = parent.querySelector('a');
        const button = parent.querySelector('button');

        parent.classList.remove( this.subMenuClass );
        link.ariaExpanded = 'false';

        if (button) {
            button.textContent = button.dataset.open;
        }
    }
}
(new Navigation());
