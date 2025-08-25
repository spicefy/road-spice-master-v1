( function( $ ) {
    'use strict';

    $( document ).ready( function() {
        
        // Initialize the focus areas section
        initFocusAreas();

        // Handle window resize events
        $( window ).on( 'resize', function() {
            positionFocusItems();
        } );

    } );

    /**
     * Initialize the focus areas section
     */
    function initFocusAreas() {
        positionFocusItems();
        setupHoverEffects();
        setupClickHandlers();
    }

    /**
     * Position the focus items around the central image
     */
    function positionFocusItems() {
        var container = $( '.solar-system' );
        var center = {
            x: container.width() / 2,
            y: container.height() / 2
        };
        var radius = Math.min( center.x, center.y ) * 0.8;
        var items = container.find( '.section-icon' );
        var angleStep = ( Math.PI * 2 ) / items.length;
        var currentAngle = 0;

        // Position each item in a circle
        items.each( function( index ) {
            var x = center.x + Math.cos( currentAngle ) * radius - $( this ).outerWidth() / 2;
            var y = center.y + Math.sin( currentAngle ) * radius - $( this ).outerHeight() / 2;
            
            $( this ).css( {
                left: x + 'px',
                top: y + 'px',
                opacity: 1
            } );

            currentAngle += angleStep;
        } );
    }

    /**
     * Setup hover effects for focus items
     */
    function setupHoverEffects() {
        $( '.section-icon' ).hover(
            function() {
                // Hover in
                $( this ).addClass( 'hover' ).css( 'z-index', 10 );
                $( this ).find( '.icon-img' ).addClass( 'pulse' );
            },
            function() {
                // Hover out
                $( this ).removeClass( 'hover' ).css( 'z-index', '' );
                $( this ).find( '.icon-img' ).removeClass( 'pulse' );
            }
        );
    }

    /**
     * Setup click handlers for focus items
     */
    function setupClickHandlers() {
        $( '.section-icon' ).on( 'click', function( e ) {
            // Smooth scroll to section if it's an internal link
            var href = $( this ).attr( 'href' );
            if ( href && href.charAt( 0 ) === '#' ) {
                e.preventDefault();
                $( 'html, body' ).animate( {
                    scrollTop: $( href ).offset().top - 100
                }, 800 );
            }
        } );
    }

    /**
     * Initialize animations when section comes into view
     */
    if ( 'IntersectionObserver' in window ) {
        var observer = new IntersectionObserver( function( entries ) {
            entries.forEach( function( entry ) {
                if ( entry.isIntersecting ) {
                    $( entry.target ).addClass( 'animate' );
                    observer.unobserve( entry.target );
                }
            } );
        }, { threshold: 0.3 } );

        $( '.focus-areas-section' ).each( function() {
            observer.observe( this );
        } );
    }

} )( jQuery );