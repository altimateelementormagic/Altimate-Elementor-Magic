(function ($) {
    "use strict";

    var editMode = false;
    //alert script starts
    var aemAlert = function ($scope, $) {
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
    var exclusiveNewsTicker = function ($scope, $) {

        var aem_news_ticker = $scope.find('.aem-news-ticker');

        if ($.isFunction($.fn.breakingNews)) {
            aem_news_ticker.each(function () {
                var t = $(this),
                    auto = t.data('autoplay') ? !0 : !1,
                    animationEffect = t.data('animation') ? t.data('animation') : '',
                    fixedPosition = t.data('fixed_position') ? t.data('fixed_position') : '',
                    pauseOnHover = t.data('pause_on_hover') ? t.data('pause_on_hover') : '',
                    animationSpeed = t.data('animation_speed') ? t.data('animation_speed') : '',
                    autoplayInterval = t.data('autoplay_interval') ? t.data('autoplay_interval') : '',
                    height = t.data('ticker_height') ? t.data('ticker_height') : '',
                    direction = t.data('direction') ? t.data('direction') : '';

                $(this).breakingNews({
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
                });
            });
        }
    }

    // countdown timer script starts
    var aemCountdownTimer = function ($scope, $) {
        var countdownTimerWrapper = $scope.find('[data-countdown]').eq(0);

        if ('undefined' !== typeof countdownTimerWrapper && null !== countdownTimerWrapper) {
            var $this = countdownTimerWrapper,
                finalDate = $this.data('countdown'),
                day = $this.data('day'),
                hours = $this.data('hours'),
                minutes = $this.data('minutes'),
                seconds = $this.data('seconds'),
                expiredText = $this.data('expired-text');

            if ($.isFunction($.fn.countdown)) {
                $this.countdown(finalDate, function (event) {
                    $(this).html(event.strftime(' ' +
                        '<div class="aem-countdown-container"><div class="aem-countdown-timer-wrapper"><span class="aem-countdown-count">%-D </span><span class="aem-countdown-title">' + day + '</span></div></div>' +
                        '<div class="aem-countdown-container"><div class="aem-countdown-timer-wrapper"><span class="aem-countdown-count">%H </span><span class="aem-countdown-title">' + hours + '</span></div></div>' +
                        '<div class="aem-countdown-container"><div class="aem-countdown-timer-wrapper"><span class="aem-countdown-count">%M </span><span class="aem-countdown-title">' + minutes + '</span></div></div>' +
                        '<div class="aem-countdown-container"><div class="aem-countdown-timer-wrapper"><span class="aem-countdown-count">%S </span><span class="aem-countdown-title">' + seconds + '</span></div></div>'));
                }).on('finish.countdown', function (event) {
                    $(this).html('<p class="message">' + expiredText + '</p>');
                });
            }
        }
    }

    // image carousel script starts
    var aemImageCarousel = function ($scope, $) {
        var logoCarouselWrapper = $scope.find('.aem-image-carousel-element').eq(0),
            slidesToShow = logoCarouselWrapper.data('slidestoshow'),
            carouselColumnTablet = logoCarouselWrapper.data('slidestoshow-tablet'),
            carouselColumnMobile = logoCarouselWrapper.data('slidestoshow-mobile'),
            slidesToScroll = logoCarouselWrapper.data('slidestoscroll'),
            carouselNav = logoCarouselWrapper.data('carousel-nav'),
            direction = logoCarouselWrapper.data('direction'),
            loop = undefined !== logoCarouselWrapper.data('loop') ? logoCarouselWrapper.data('loop') : false,
            autoPlay = undefined !== logoCarouselWrapper.data('autoplay') ? logoCarouselWrapper.data('autoplay') : false,
            autoplaySpeed = undefined !== logoCarouselWrapper.data('autoplayspeed') ? logoCarouselWrapper.data('autoplayspeed') : false,
            Smooth = undefined !== logoCarouselWrapper.data('smooth') ? logoCarouselWrapper.data('smooth') : false,
            SmoothSpeed = undefined !== logoCarouselWrapper.data('smooth-speed') ? logoCarouselWrapper.data('smooth-speed') : 300;

        var arrows, dots, cssEase;

        if (Smooth) {
            cssEase = 'linear';
            autoplaySpeed = 0;
        } else {
            cssEase = 'ease';
        }
        if ('both' === carouselNav) {
            arrows = true;
            dots = true;
        } else if ('arrows' === carouselNav) {
            arrows = true;
            dots = false;
        } else if ('dots' === carouselNav) {
            arrows = false;
            dots = true;
        } else {
            arrows = false;
            dots = false;
        }

        if ($.isFunction($.fn.slick)) {
            logoCarouselWrapper.slick({
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
            });
        }
    }
    // image carousel script ends

    // accordion script starts

    var aemAccordion = function ($scope, $) {
        var accordionTitle = $scope.find('.aem-accordion-title');

        // Open default actived tab
        accordionTitle.each(function () {
            if ($(this).hasClass('active-default')) {
                $(this).addClass('active');
                $(this).next('.aem-accordion-content').slideDown();
            }
        });

        // Remove multiple click event for nested accordion
        accordionTitle.unbind('click');

        //$accordionWrapper.children('.aem-accordion-content').first().show();
        accordionTitle.click(function (e) {
            e.preventDefault();
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).next().slideUp(400);
            } else {
                $(this).parent().parent().find('.aem-accordion-title').removeClass('active');
                $(this).parent().parent().find('.aem-accordion-content').slideUp(400);
                $(this).toggleClass('active');
                $(this).next().slideToggle(400);
            }
        });
    }
    // accordion script ends

    // progress bar script starts

    function animatedProgressbar(id, type, value, strokeColor, trailColor, strokeWidth, strokeTrailWidth) {
        var triggerClass = '.aem-progress-bar-' + id;
        if ('function' === typeof ldBar) {
            if ('line' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M0 10L100 10',
                    'aspect-ratio': 'none',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
            if ('line-bubble' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M0 10L100 10',
                    'aspect-ratio': 'none',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
                $($('.aem-progress-bar-' + id).find('.ldBar-label')).animate({
                    left: value + '%'
                }, 1000, 'swing');
            }
            if ('circle' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M50 10A40 40 0 0 1 50 90A40 40 0 0 1 50 10',
                    'stroke-dir': 'normal',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
            if ('fan' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M10 90A40 40 0 0 1 90 90',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
        }
    }

    var aemProgressBar = function ($scope, $) {
        var progressBarWrapper = $scope.find('[data-progress-bar]').eq(0);
        if ($.isFunction($.fn.waypoint)) {
            progressBarWrapper.waypoint(function () {
                var element = $(this.element),
                    id = element.data('id'),
                    type = element.data('type'),
                    value = element.data('progress-bar-value'),
                    strokeWidth = element.data('progress-bar-stroke-width'),
                    strokeTrailWidth = element.data('progress-bar-stroke-trail-width'),
                    color = element.data('stroke-color'),
                    trailColor = element.data('stroke-trail-color');
                animatedProgressbar(id, type, value, color, trailColor, strokeWidth, strokeTrailWidth);
                this.destroy();
            }, {
                offset: 'bottom-in-view'
            });
        }
    }
    // progress bar script ends

    // google maps script starts
    var aemGoogleMaps = function ($scope, $) {

        if ($.isFunction($.fn.gmap3)) {
            var googleMaps = $scope.find('.aem-google-maps').eq(0),
                latitude = googleMaps.data('aem-lat'),
                longitude = googleMaps.data('aem-lng'),
                mapTheme = googleMaps.data('aem-theme'),
                mapZoom = googleMaps.data('aem-zoom'),
                mapAddress = googleMaps.data('aem-address'),
                map_streeview_control = googleMaps.data('aem-streeview-control'),
                map_type_control = googleMaps.data('aem-type-control'),
                map_zoom_control = googleMaps.data('aem-zoom-control'),
                map_fullscreen_control = googleMaps.data('aem-fullscreen-control'),
                map_scroll_zoom = googleMaps.data('aem-scroll-zoom'),
                center = [latitude, longitude],
                address = false;

            googleMaps.gmap3({
                center: center,
                address: address,
                zoom: mapZoom,
                streetViewControl: map_streeview_control,
                mapTypeControl: map_type_control,
                zoomControl: map_zoom_control,
                fullscreenControl: map_fullscreen_control,
                scrollwheel: map_scroll_zoom,
                mapTypeId: mapTheme,
            }).styledmaptype(
                "standard",
                [],
                { name: "standard" }
            ).styledmaptype(
                "retro",
                [{ "elementType": "geometry", "stylers": [{ "color": "#ebe3cd" }] }, { "elementType": "labels.text.fill", "stylers": [{ "color": "#523735" }] }, { "elementType": "labels.text.stroke", "stylers": [{ "color": "#f5f1e6" }] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{ "color": "#c9b2a6" }] }, { "featureType": "administrative.land_parcel", "elementType": "geometry.stroke", "stylers": [{ "color": "#dcd2be" }] }, { "featureType": "administrative.land_parcel", "elementType": "labels.text.fill", "stylers": [{ "color": "#ae9e90" }] }, { "featureType": "landscape.natural", "elementType": "geometry", "stylers": [{ "color": "#dfd2ae" }] }, { "featureType": "poi", "elementType": "geometry", "stylers": [{ "color": "#dfd2ae" }] }, { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [{ "color": "#93817c" }] }, { "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [{ "color": "#a5b076" }] }, { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [{ "color": "#447530" }] }, { "featureType": "road", "elementType": "geometry", "stylers": [{ "color": "#f5f1e6" }] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [{ "color": "#fdfcf8" }] }, { "featureType": "road.highway", "elementType": "geometry", "stylers": [{ "color": "#f8c967" }] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{ "color": "#e9bc62" }] }, { "featureType": "road.highway.controlled_access", "elementType": "geometry", "stylers": [{ "color": "#e98d58" }] }, { "featureType": "road.highway.controlled_access", "elementType": "geometry.stroke", "stylers": [{ "color": "#db8555" }] }, { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [{ "color": "#806b63" }] }, { "featureType": "transit.line", "elementType": "geometry", "stylers": [{ "color": "#dfd2ae" }] }, { "featureType": "transit.line", "elementType": "labels.text.fill", "stylers": [{ "color": "#8f7d77" }] }, { "featureType": "transit.line", "elementType": "labels.text.stroke", "stylers": [{ "color": "#ebe3cd" }] }, { "featureType": "transit.station", "elementType": "geometry", "stylers": [{ "color": "#dfd2ae" }] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [{ "color": "#b9d3c2" }] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [{ "color": "#92998d" }] }],
                { name: "retro" }
            ).styledmaptype(
                "silver",
                [{ "elementType": "geometry", "stylers": [{ "color": "#f5f5f5" }] }, { "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "elementType": "labels.text.fill", "stylers": [{ "color": "#616161" }] }, { "elementType": "labels.text.stroke", "stylers": [{ "color": "#f5f5f5" }] }, { "featureType": "administrative.land_parcel", "elementType": "labels.text.fill", "stylers": [{ "color": "#bdbdbd" }] }, { "featureType": "poi", "elementType": "geometry", "stylers": [{ "color": "#eeeeee" }] }, { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [{ "color": "#757575" }] }, { "featureType": "poi.park", "elementType": "geometry", "stylers": [{ "color": "#e5e5e5" }] }, { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [{ "color": "#9e9e9e" }] }, { "featureType": "road", "elementType": "geometry", "stylers": [{ "color": "#ffffff" }] }, { "featureType": "road.arterial", "elementType": "labels.text.fill", "stylers": [{ "color": "#757575" }] }, { "featureType": "road.highway", "elementType": "geometry", "stylers": [{ "color": "#dadada" }] }, { "featureType": "road.highway", "elementType": "labels.text.fill", "stylers": [{ "color": "#616161" }] }, { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [{ "color": "#9e9e9e" }] }, { "featureType": "transit.line", "elementType": "geometry", "stylers": [{ "color": "#e5e5e5" }] }, { "featureType": "transit.station", "elementType": "geometry", "stylers": [{ "color": "#eeeeee" }] }, { "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#c9c9c9" }] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [{ "color": "#9e9e9e" }] }],
                { name: "silver" }
            ).styledmaptype(
                "dark",
                [{ "elementType": "geometry", "stylers": [{ "color": "#212121" }] }, { "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "elementType": "labels.text.fill", "stylers": [{ "color": "#757575" }] }, { "elementType": "labels.text.stroke", "stylers": [{ "color": "#212121" }] }, { "featureType": "administrative", "elementType": "geometry", "stylers": [{ "color": "#757575" }] }, { "featureType": "administrative.country", "elementType": "labels.text.fill", "stylers": [{ "color": "#9e9e9e" }] }, { "featureType": "administrative.land_parcel", "stylers": [{ "visibility": "off" }] }, { "featureType": "administrative.locality", "elementType": "labels.text.fill", "stylers": [{ "color": "#bdbdbd" }] }, { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [{ "color": "#757575" }] }, { "featureType": "poi.park", "elementType": "geometry", "stylers": [{ "color": "#181818" }] }, { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [{ "color": "#616161" }] }, { "featureType": "poi.park", "elementType": "labels.text.stroke", "stylers": [{ "color": "#1b1b1b" }] }, { "featureType": "road", "elementType": "geometry.fill", "stylers": [{ "color": "#2c2c2c" }] }, { "featureType": "road", "elementType": "labels.text.fill", "stylers": [{ "color": "#8a8a8a" }] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [{ "color": "#373737" }] }, { "featureType": "road.highway", "elementType": "geometry", "stylers": [{ "color": "#3c3c3c" }] }, { "featureType": "road.highway.controlled_access", "elementType": "geometry", "stylers": [{ "color": "#4e4e4e" }] }, { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [{ "color": "#616161" }] }, { "featureType": "transit", "elementType": "labels.text.fill", "stylers": [{ "color": "#757575" }] }, { "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#000000" }] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [{ "color": "#3d3d3d" }] }],
                { name: "dark" }
            ).styledmaptype(
                "night",
                [{ "elementType": "geometry", "stylers": [{ "color": "#242f3e" }] }, { "elementType": "labels.text.fill", "stylers": [{ "color": "#746855" }] }, { "elementType": "labels.text.stroke", "stylers": [{ "color": "#242f3e" }] }, { "featureType": "administrative.locality", "elementType": "labels.text.fill", "stylers": [{ "color": "#d59563" }] }, { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [{ "color": "#d59563" }] }, { "featureType": "poi.park", "elementType": "geometry", "stylers": [{ "color": "#263c3f" }] }, { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [{ "color": "#6b9a76" }] }, { "featureType": "road", "elementType": "geometry", "stylers": [{ "color": "#38414e" }] }, { "featureType": "road", "elementType": "geometry.stroke", "stylers": [{ "color": "#212a37" }] }, { "featureType": "road", "elementType": "labels.text.fill", "stylers": [{ "color": "#9ca5b3" }] }, { "featureType": "road.highway", "elementType": "geometry", "stylers": [{ "color": "#746855" }] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{ "color": "#1f2835" }] }, { "featureType": "road.highway", "elementType": "labels.text.fill", "stylers": [{ "color": "#f3d19c" }] }, { "featureType": "transit", "elementType": "geometry", "stylers": [{ "color": "#2f3948" }] }, { "featureType": "transit.station", "elementType": "labels.text.fill", "stylers": [{ "color": "#d59563" }] }, { "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#17263c" }] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [{ "color": "#515c6d" }] }, { "featureType": "water", "elementType": "labels.text.stroke", "stylers": [{ "color": "#17263c" }] }],
                { name: "night" }
            ).styledmaptype(
                "aubergine",
                [{ "elementType": "geometry", "stylers": [{ "color": "#1d2c4d" }] }, { "elementType": "labels.text.fill", "stylers": [{ "color": "#8ec3b9" }] }, { "elementType": "labels.text.stroke", "stylers": [{ "color": "#1a3646" }] }, { "featureType": "administrative.country", "elementType": "geometry.stroke", "stylers": [{ "color": "#4b6878" }] }, { "featureType": "administrative.land_parcel", "elementType": "labels.text.fill", "stylers": [{ "color": "#64779e" }] }, { "featureType": "administrative.province", "elementType": "geometry.stroke", "stylers": [{ "color": "#4b6878" }] }, { "featureType": "landscape.man_made", "elementType": "geometry.stroke", "stylers": [{ "color": "#334e87" }] }, { "featureType": "landscape.natural", "elementType": "geometry", "stylers": [{ "color": "#023e58" }] }, { "featureType": "poi", "elementType": "geometry", "stylers": [{ "color": "#283d6a" }] }, { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [{ "color": "#6f9ba5" }] }, { "featureType": "poi", "elementType": "labels.text.stroke", "stylers": [{ "color": "#1d2c4d" }] }, { "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [{ "color": "#023e58" }] }, { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [{ "color": "#3C7680" }] }, { "featureType": "road", "elementType": "geometry", "stylers": [{ "color": "#304a7d" }] }, { "featureType": "road", "elementType": "labels.text.fill", "stylers": [{ "color": "#98a5be" }] }, { "featureType": "road", "elementType": "labels.text.stroke", "stylers": [{ "color": "#1d2c4d" }] }, { "featureType": "road.highway", "elementType": "geometry", "stylers": [{ "color": "#2c6675" }] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{ "color": "#255763" }] }, { "featureType": "road.highway", "elementType": "labels.text.fill", "stylers": [{ "color": "#b0d5ce" }] }, { "featureType": "road.highway", "elementType": "labels.text.stroke", "stylers": [{ "color": "#023e58" }] }, { "featureType": "transit", "elementType": "labels.text.fill", "stylers": [{ "color": "#98a5be" }] }, { "featureType": "transit", "elementType": "labels.text.stroke", "stylers": [{ "color": "#1d2c4d" }] }, { "featureType": "transit.line", "elementType": "geometry.fill", "stylers": [{ "color": "#283d6a" }] }, { "featureType": "transit.station", "elementType": "geometry", "stylers": [{ "color": "#3a4762" }] }, { "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#0e1626" }] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [{ "color": "#4e6d70" }] }],
                { name: "aubergine" }
            );
        }
    }

    // google maps script ends
    // Post grid script starts

    var aemPostGrid = function ($scope, $) {
        var aemPostgridWrapped = $scope.find('.aem-post-grid');

        var aemPostArticle = aemPostgridWrapped.find('.aem-post-grid-three .aem-post-grid-container.aem-post-grid-equal-height-yes');
        var aemPostWrapper = aemPostgridWrapped.find('.aem-row-wrapper');
        // Match Height
        aemPostArticle.matchHeight({
            byRow: 0
        });

        var btn = aemPostgridWrapped.find('.aem-post-grid-paginate-btn');
        var btnText = btn.text();

        var page = 2;

        $(btn).on("click", function (e) {
            e.preventDefault();
            $.ajax({
                url: aem_ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'ajax_pagination',
                    paged: page,
                    post_type: $(this).data('post-type'),
                    posts_per_page: $(this).data('posts_per_page'),
                    post_offset: $(this).data('post-offset'),
                    post_thumbnail: $(this).data('post-thumbnail'),
                    post_thumb_size: $(this).data('post-thumb-size'),
                    equal_height: $(this).data('equal_height'),
                    enable_details_btn: $(this).data('enable_details_btn'),
                    details_btn_text: $(this).data('details_btn_text'),
                    details_btn_text_tab: $(this).data('details_btn_text_tab'),
                    show_user_avatar: $(this).data('show-user-avatar'),
                    show_user_name: $(this).data('show_user_name'),
                    post_data_position: $(this).data('post_data_position'),
                    show_title: $(this).data('show_title'),
                    show_title_parmalink: $(this).data('show_title_parmalink'),
                    title_full: $(this).data('title_full'),
                    title_tag: $(this).data('title_tag'),
                    show_read_time: $(this).data('show_read_time'),
                    show_comment: $(this).data('show_comment'),
                    show_excerpt: $(this).data('show_excerpt'),
                    excerpt_length: $(this).data('excerpt_length'),
                    show_user_name_tag: $(this).data('show_user_name_tag'),
                    user_name_tag: $(this).data('user_name_tag'),
                    show_date: $(this).data('show_date'),
                    show_date_tag: $(this).data('show_date_tag'),
                    date_tag: $(this).data('date_tag'),
                    title_length: $(this).data('title_length'),
                    image_align: $(this).data('image_align'),
                    category_default_position: $(this).data('category_default_position'),
                    category_position_over_image: $(this).data('category_position_over_image'),
                    show_category: $(this).data('show_category'),
                    category: $(this).data('category'),
                    tags: $(this).data('tags'),
                    offset: $(this).data('offset'),
                    exclude_post: $(this).data('exclude_post')
                },
                beforeSend: function (xhr) {
                    btn.text('Loading...');
                },
                success: function (html) {
                    if (html.length > 0) {
                        btn.text(btnText);
                        aemPostWrapper.append(html);
                        page++;
                        setTimeout(function () {
                            var newExadPostArticle = aemPostgridWrapped.find('.aem-post-grid-three .aem-post-grid-container.aem-post-grid-equal-height-yes');
                            newExadPostArticle.matchHeight({
                                byRow: 0
                            });
                        }, 10);
                    } else {
                        btn.remove();
                    }
                },
            });
        });
    }

    // post grid script ends

    $(window).on('elementor/frontend/init', function () {
        if (elementorFrontend.isEditMode()) {
            editMode = true;
        }

        elementorFrontend.hooks.addAction('frontend/element_ready/aem-alert.default', aemAlert);
        elementorFrontend.hooks.addAction('frontend/element_ready/aem-news-ticker.default', exclusiveNewsTicker);
        elementorFrontend.hooks.addAction('frontend/element_ready/aem-countdown-timer.default', aemCountdownTimer);
        elementorFrontend.hooks.addAction('frontend/element_ready/aem-image-carousel.default', aemImageCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/aem-accordion.default', aemAccordion);
        elementorFrontend.hooks.addAction('frontend/element_ready/aem-progress-bar.default', aemProgressBar);
        elementorFrontend.hooks.addAction('frontend/element_ready/aem-google-maps.default', aemGoogleMaps);
        elementorFrontend.hooks.addAction('frontend/element_ready/aem-post-grid.default', aemPostGrid);


    });

}(jQuery));