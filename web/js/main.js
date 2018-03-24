/*price range*/

$('#sl2').slider();

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});

$("#phone").mask("+38 (099) 999 99 99");

$(document).on('click', '[data-to-cart]', function () {
    var _this = $(this);
    var _quantity = 1;
    _this.addClass('cart-loading');
    _this.find('i').removeClass('fa-shopping-cart').addClass('fa-spin fa-spinner');

    if (_this.data('quantity') === 'y') _quantity = $('#quantity-field').val();

    $.get(
        '/catalog/to-cart',
        {
            product_id: _this.data('to-cart'),
            quantity: _quantity
        }, function (data) {
            setTimeout(function () {
                _this.removeClass('cart-loading').addClass('cart-done');
                _this.find('i').removeClass('fa-spin fa-spinner').addClass('fa-check');
                _this.find('span').html('Добавлено');
                $('.cart-count-element').html(data);
            }, 300)
        }
    )
}).on('click', '[data-open-cart]', function () {
    // $.get(
    //     '/catalog/ajax-cart',
    //     {}, function (data) {
    //         $('.cart-modal').find('.modal-body').html(data);
    //     }
    // );
    // $('.cart-modal').modal('show');
}).on('change input', '[data-price-change]', function () {
    var _this = $(this);
    var _id = _this.data('price-change');

    console.info(_this.val());

    $('#sum' + _id).html((_this.val() * parseFloat($('#price' + _id + ' p').html())).toFixed(2) + ' грн');

    update_total_sum()
}).on('click', '[data-remove-from-cart]', function () {
    var _this = $(this);

    $.get(
        '/checkout/remove-from-cart',
        {
            id: _this.data('remove-from-cart')
        }, function (data) {
            $('.cart-count-element').html(data);
            $('#cart_element_' + _this.data('remove-from-cart')).remove();

            update_total_sum()
        }
    )
});

function update_total_sum() {
    var sum = 0;

    $('.cart_total_price').each(function () {
        sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
    });

    $('#total_order_sum').html((sum).toFixed(2) + ' грн');
}