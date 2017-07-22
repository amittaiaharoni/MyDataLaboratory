/*global $ */
/*jslint browser: true */
$(function () {
    "use strict";
    $('.mdl-widget-add-retailer .mdl-widget-form').on('submit', function (e) {
        var $t = $(this),
            $value = $t.find('.mdl-widget-add-retailer-value'),
            retailer = $value.val();
        if (retailer) {
            $.ajax({
                url: $t.closest('.mdl-widget').data('addUrl'),
                type: 'POST',
                data: {
                    retailer: retailer
                },
                success: function success(response) {
                    if (response.success && response.url) {
                        document.location = response.url;
                    }
                }
            });
        }
        e.preventDefault();
    });
});