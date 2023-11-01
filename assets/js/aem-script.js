(function ($) {
    "use strict";

    var editMode = false;
    //alert script starts
    var exclusiveAlert = function ($scope, $) {
        var alertClose = $scope.find('[data-alert]').eq(0);
        alertClose.each(function (index) {
            var alert = $(this);
            alert.find('.aem-alert-element-dismiss-icon').click(function (e) {
                e.preventDefault();
                alert.fadeOut(500);
            });
            alert.find('.aem-alert-element-dismiss-button').click(function (e) {
                e.preventDefault();
                alert.fadeOut(500);
            });
        });
    }
    var exclusiveNewsTicker = function( $scope, $ ) {

        var goee_news_ticker = $scope.find( '.aem-news-ticker' );
    
        if ( $.isFunction( $.fn.breakingNews ) ) {  
            goee_news_ticker.each( function() {
                var t            = $(this),
                auto             = t.data( 'autoplay' ) ? !0 : !1,
                animationEffect  = t.data( 'animation' ) ? t.data( 'animation' ) : '',                                   
                fixedPosition      = t.data( 'fixed_position' ) ? t.data( 'fixed_position' ) : '',                                   
                pauseOnHover     = t.data( 'pause_on_hover' ) ? t.data( 'pause_on_hover' ) : '',                                   
                animationSpeed   = t.data( 'animation_speed' ) ? t.data( 'animation_speed' ) : '',                                   
                autoplayInterval = t.data( 'autoplay_interval' ) ? t.data( 'autoplay_interval' ) : '',                                   
                height           = t.data( 'ticker_height' ) ? t.data( 'ticker_height' ) : '',                                   
                direction        = t.data( 'direction' ) ? t.data( 'direction' ) : ''; 
    
                $(this).breakingNews( {
                    position: fixedPosition,
                    play: auto,
                    direction: direction,
                    scrollSpeed: animationSpeed,
                    stopOnHover: pauseOnHover,
                    effect: animationEffect,
                    delayTimer: autoplayInterval,                    
                    height: height,
                    fontSize: 'default',
                    themeColor: 'default',
                    background: 'default'             
                } );    
            } );
        }
    }

    // countdown timer script starts
    var exclusiveCountdownTimer = function ( $scope, $ ) {
        var countdownTimerWrapper = $scope.find( '[data-countdown]' ).eq(0);

        if ( 'undefined' !== typeof countdownTimerWrapper && null !== countdownTimerWrapper ) {
            var $this   = countdownTimerWrapper,
            finalDate   = $this.data( 'countdown' ),
            day         = $this.data( 'day' ),
            hours       = $this.data( 'hours' ),
            minutes     = $this.data( 'minutes' ),
            seconds     = $this.data( 'seconds' ),
            expiredText = $this.data( 'expired-text' );

            if ( $.isFunction( $.fn.countdown ) ) {
                $this.countdown( finalDate, function ( event ) {
                    $( this ).html( event.strftime(' ' +
                        '<div class="aem-countdown-container"><div class="aem-countdown-timer-wrapper"><span class="aem-countdown-count">%-D </span><span class="aem-countdown-title">' + day + '</span></div></div>' +
                        '<div class="aem-countdown-container"><div class="aem-countdown-timer-wrapper"><span class="aem-countdown-count">%H </span><span class="aem-countdown-title">' + hours + '</span></div></div>' +
                        '<div class="aem-countdown-container"><div class="aem-countdown-timer-wrapper"><span class="aem-countdown-count">%M </span><span class="aem-countdown-title">' + minutes + '</span></div></div>' +
                        '<div class="aem-countdown-container"><div class="aem-countdown-timer-wrapper"><span class="aem-countdown-count">%S </span><span class="aem-countdown-title">' + seconds + '</span></div></div>'));
                } ).on( 'finish.countdown', function (event) {
                    $(this).html( '<p class="message">'+ expiredText +'</p>' );
                } );
            }
        }
    }

// image carousel script starts
var aemImageCarousel   = function ( $scope, $ ) {
    var logoCarouselWrapper = $scope.find( '.aem-image-carousel-element' ).eq(0),
    slidesToShow            = logoCarouselWrapper.data( 'slidestoshow' ),
    carouselColumnTablet    = logoCarouselWrapper.data( 'slidestoshow-tablet' ),
    carouselColumnMobile    = logoCarouselWrapper.data( 'slidestoshow-mobile' ),
    slidesToScroll          = logoCarouselWrapper.data( 'slidestoscroll' ),
    carouselNav             = logoCarouselWrapper.data( 'carousel-nav' ),
    direction               = logoCarouselWrapper.data( 'direction' ),
    loop                    = undefined !== logoCarouselWrapper.data( 'loop' ) ? logoCarouselWrapper.data( 'loop' ) : false,
    autoPlay                = undefined !== logoCarouselWrapper.data( 'autoplay' ) ? logoCarouselWrapper.data( 'autoplay' ) : false,
    autoplaySpeed           = undefined !== logoCarouselWrapper.data( 'autoplayspeed' ) ? logoCarouselWrapper.data( 'autoplayspeed' ) : false,
    Smooth                  = undefined !== logoCarouselWrapper.data( 'smooth' ) ? logoCarouselWrapper.data( 'smooth' ) : false,
    SmoothSpeed             = undefined !== logoCarouselWrapper.data( 'smooth-speed' ) ? logoCarouselWrapper.data( 'smooth-speed' ) : 300;

    var arrows, dots, cssEase;

    if ( Smooth ){
        cssEase = 'linear';
        autoplaySpeed = 0;
    } else {
        cssEase = 'ease';
    }
    if ( 'both' === carouselNav ) {
        arrows = true;
        dots   = true;
    } else if ( 'arrows' === carouselNav ) {
        arrows = true;
        dots   = false;
    } else if ( 'dots' === carouselNav ) {
        arrows = false;
        dots   = true;
    } else {
        arrows = false;
        dots   = false;
    }

    if ( $.isFunction( $.fn.slick ) ) {
        logoCarouselWrapper.slick( {
            infinite: loop,
            slidesToShow: slidesToShow,
            slidesToScroll: slidesToScroll,
            autoplay: autoPlay,
            autoplaySpeed: autoplaySpeed,
            dots: dots,
            rtl: direction,
            arrows: arrows,
            speed: SmoothSpeed,
            cssEase: cssEase,
            prevArrow: '<div class="aem-image-carousel-prev"><i class="eicon-chevron-left"></i></div>',
            nextArrow: '<div class="aem-image-carousel-next"><i class="eicon-chevron-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: carouselColumnTablet
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: carouselColumnTablet
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: carouselColumnMobile
                    }
                }
            ]
        } );	
    }
}

// image carousel script ends

    // countdown timer script ends

    $(window).on('elementor/frontend/init', function () {
        if (elementorFrontend.isEditMode()) {
            editMode = true;
        }
        
        elementorFrontend.hooks.addAction( 'frontend/element_ready/aem-exclusive-alert.default', exclusiveAlert );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/aem-news-ticker.default', exclusiveNewsTicker );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/aem-countdown-timer.default', exclusiveCountdownTimer );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/aem-image-carousel.default', aemImageCarousel );

    });

}(jQuery));