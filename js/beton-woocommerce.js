jQuery(document).ready(function ($) {
    $(document).on('click', '#checkout-billing-shipping-confirm', function(){
        $('.validate-required input, .validate-required select').trigger('validate');

        var hasError = false;
        $('.checkout-billing-fields .woocommerce-invalid-required-field').each(function () {
            hasError = true; 
        });

        if($('#ship-to-different-address-checkbox').is(':checked')) {
            console.log('Ship to diff address checked');
            $('.woocommerce-invalid-required-field').each(function () {
                hasError = true; 
            });
        }

        if (hasError) {
            $('html, body').animate({
                scrollTop: $('.woocommerce-invalid-required-field:first').offset().top - 50
            }, 500);

            if (!$('.woocommerce-error').length) {
                $('<ul class="woocommerce-error"><li>Vul alle verplichte velden in.</li></ul>')
                    .prependTo('form.woocommerce-checkout');
            }
        } else {

            $(this).parent('div').addClass('d-none');
            $('.checkout-payment-wrapper').removeClass('d-none');
            $('.checkout-payment-wrapper').closest('.checkout-box').find('.checkout-icons-btn').addClass('d-none');
            $(this).closest('.checkout-box').find('.checkout-icons-btn').removeClass('d-none');
            $('.checkout-payment-wrapper').closest('.checkout-box').addClass('active');
            $(this).closest('.checkout-box').addClass('deactive');
        }
    });

    $(document).on('click', '#checkout-payment-confirm', function(){
        $(this).parent('div').addClass('d-none');
        $('.checkout-confirmation-content-wrapper').removeClass('d-none');
        $('.checkout-confirmation-content-wrapper').closest('.checkout-box').find('.checkout-icons-btn').addClass('d-none');
        $(this).closest('.checkout-box').find('.checkout-icons-btn').removeClass('d-none');
        $('.checkout-confirmation-content-wrapper').closest('.checkout-box').addClass('active');
        $(this).closest('.checkout-box').removeClass('active');
        $(this).closest('.checkout-box').addClass('deactive');
    });

    $(document).on('click', '.checkout-icons-btn', function(){
        $('.checkout-box').removeClass('active');
        $('.checkout-box').addClass('deactive');
        $(this).closest('.checkout-box').removeClass('deactive');
        $(this).closest('.checkout-box').addClass('active');
        $(this).closest('.checkout-box').find('.checkout-content-wrapper').removeClass('d-none');

        $('.checkout-box').each(function(){
            if( $(this).hasClass('deactive')) {
                $(this).find('.checkout-content-wrapper').addClass('d-none');
                $(this).find('.checkout-icons-btn').removeClass('d-none');
            } else {
                $(this).find('.checkout-content-wrapper').removeClass('d-none');
                $(this).find('.checkout-icons-btn').addClass('d-none');
            }
        });
    });
    
 });