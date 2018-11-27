/*-----------------------------------------------------------------
    Magnific Popup Behavior
-------------------------------------------------------------------*/
(function ($) {
    $(document).ready(function () {


    // option 1//
    /*-----------------------------------------------------------------
	Init MFP
	-------------------------------------------------------------------*/
        $('.open-popup-link').magnificPopup({
            type: 'inline',
            removalDelay: 500,
            mainClass: 'mfp-zoom-in',
            midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
            callbacks: {
                beforeClose: function () {
                    $('.mfp-bg').addClass('mfp-removing');
                }
            }
        });

    // option 2//
    /*-----------------------------------------------------------------
    Magnific Popup Gallery Images
    -------------------------------------------------------------------*/
        $('.jnilla-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true
            },
            removalDelay: 500,
            callbacks: {
                beforeOpen: function () {
                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                    this.st.mainClass = this.st.el.attr('data-effect');
                }
            },
            closeOnContentClick: true,
            midClick: true
        });

    });
})(jQuery);