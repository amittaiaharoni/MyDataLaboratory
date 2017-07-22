/*global $ */
$(function () {
    "use strict";
    var deleteUrl = $('#competitors-list').data('deleteUrl');
    $('.fa-trash-o').on('click', function (e) {
        var id = $(this).data('id'),
            $li = $(this).closest('li');
        e.preventDefault();
        $.ajax({
            url: deleteUrl.replace(':id', id),
            method: 'DELETE'
        }).then(function (response) {
            if (response.success) {
                $li.remove();
            }
        });
    });
});