/*
 Dropdown with Multiple checkbox select with jQuery and some other custom code
 (c) 2016 Milcho Koroveshovski
 license: http://www.opensource.org/licenses/mit-license.php
 */
$("#tables_selectbox .dropdown dt a").on('click', function () {
    $("#tables_selectbox .dropdown dd ul").slideDown('fast');
    if ($("#tables_selectbox .dropdown dt a").find($(".fa")).hasClass('fa-caret-right'))
    {
        $("#tables_selectbox .dropdown dt a").find($(".fa")).removeClass('fa-caret-right').addClass('fa-caret-down');
    } else {
        if ($("#tables_selectbox .dropdown dt a").find($(".fa")).hasClass('fa-caret-down'))
        {
            $("#tables_selectbox .dropdown dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
            $("#tables_selectbox .dropdown dd ul").slideUp('fast');
        }
        $("#tables_selectbox .dropdown dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
        $("#tables_selectbox .dropdown dd ul").slideUp('fast');
    }

});

$("#tables_selectbox .dropdown_2 dt a").on('click', function () {
    $("#tables_selectbox .dropdown_2 dd ul").slideDown('fast');
    if ($("#tables_selectbox .dropdown_2 dt a").find($(".fa")).hasClass('fa-caret-right'))
    {
        $("#tables_selectbox .dropdown_2 dt a").find($(".fa")).removeClass('fa-caret-right').addClass('fa-caret-down');
    } else {
        if ($("#tables_selectbox .dropdown_2 dt a").find($(".fa")).hasClass('fa-caret-down'))
        {
            $("#tables_selectbox .dropdown_2 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
            $("#tables_selectbox .dropdown_2 dd ul").slideUp('fast');
        }
        $("#tables_selectbox .dropdown_2 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
        $("#tables_selectbox .dropdown_2 dd ul").slideUp('fast');
    }
});
$("#tables_selectbox .dropdown_3 dt a").on('click', function () {
    $("#tables_selectbox .dropdown_3 dd ul").slideDown('fast');
    if ($("#tables_selectbox .dropdown_3 dt a").find($(".fa")).hasClass('fa-caret-right'))
    {
        $("#tables_selectbox .dropdown_3 dt a").find($(".fa")).removeClass('fa-caret-right').addClass('fa-caret-down');
    } else {
        if ($("#tables_selectbox .dropdown_3 dt a").find($(".fa")).hasClass('fa-caret-down')) {
            $("#tables_selectbox .dropdown_3 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
            $("#tables_selectbox .dropdown_3 dd ul").slideUp('fast');
        }
        $("#tables_selectbox .dropdown_3 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
        $("#tables_selectbox .dropdown_3 dd ul").slideUp('fast');
    }
});
$("#tables_selectbox .dropdown_4 dt a").on('click', function () {
    $("#tables_selectbox .dropdown_4 dd ul").slideDown('fast');
    if ($("#tables_selectbox .dropdown_4 dt a").find($(".fa")).hasClass('fa-caret-right')) {
        $("#tables_selectbox .dropdown_4 dt a").find($(".fa")).removeClass('fa-caret-right').addClass('fa-caret-down');
    } else {
        if ($("#tables_selectbox .dropdown_4 dt a").find($(".fa")).hasClass('fa-caret-down')) {
            $("#tables_selectbox .dropdown_4 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
            $("#tables_selectbox .dropdown_4 dd ul").slideUp('fast');
        }
        $("#tables_selectbox .dropdown_4 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
        $("#tables_selectbox .dropdown_4 dd ul").slideUp('fast');
    }
});
$("#tables_selectbox .dropdown_6 dt a").on('click', function () {
    $("#tables_selectbox .dropdown_6 dd ul").slideDown('fast');
    if ($("#tables_selectbox .dropdown_6 dt a").find($(".fa")).hasClass('fa-caret-right')) {
        $("#tables_selectbox .dropdown_6 dt a").find($(".fa")).removeClass('fa-caret-right').addClass('fa-caret-down');
    } else {
        if ($("#tables_selectbox .dropdown_6 dt a").find($(".fa")).hasClass('fa-caret-down')) {
            $("#tables_selectbox .dropdown_6 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
            $("#tables_selectbox .dropdown_6 dd ul").slideUp('fast');
        }
        $("#tables_selectbox .dropdown_6 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
        $("#tables_selectbox .dropdown_6 dd ul").slideUp('fast');
    }
});
$("#tables_selectbox .dropdown_7 dt a").on('click', function () {
    $("#tables_selectbox .dropdown_7 dd ul").slideDown('fast');
    if ($("#tables_selectbox .dropdown_7 dt a").find($(".fa")).hasClass('fa-caret-right')) {
        $("#tables_selectbox .dropdown_7 dt a").find($(".fa")).removeClass('fa-caret-right').addClass('fa-caret-down');
    } else {
        if ($("#tables_selectbox .dropdown_7 dt a").find($(".fa")).hasClass('fa-caret-down')) {
            $("#tables_selectbox .dropdown_7 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
            $("#tables_selectbox .dropdown_7 dd ul").slideUp('fast');
        }
        $("#tables_selectbox .dropdown_7 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
        $("#tables_selectbox .dropdown_7 dd ul").slideUp('fast');
    }
});
$("#tables_selectbox .dropdown_8 dt a").on('click', function () {
    $("#tables_selectbox .dropdown_8 dd ul").slideDown('fast');
    if ($("#tables_selectbox .dropdown_8 dt a").find($(".fa")).hasClass('fa-caret-right'))
    {
        $("#tables_selectbox .dropdown_8 dt a").find($(".fa")).removeClass('fa-caret-right').addClass('fa-caret-down');
    } else
    {
        if ($("#tables_selectbox .dropdown_8 dt a").find($(".fa")).hasClass('fa-caret-down'))
        {
            $("#tables_selectbox .dropdown_8 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
            $("#tables_selectbox .dropdown_8 dd ul").slideUp('fast');
        }
        $("#tables_selectbox .dropdown_8 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
        $("#tables_selectbox .dropdown_8 dd ul").slideUp('fast');
    }
});
$("#tables_selectbox .dropdown_9 dt a").on('click', function () {
    $("#tables_selectbox .dropdown_9 dd ul").slideDown('fast');
    if ($("#tables_selectbox .dropdown_9 dt a").find($(".fa")).hasClass('fa-caret-right'))
    {
        $("#tables_selectbox .dropdown_9 dt a").find($(".fa")).removeClass('fa-caret-right').addClass('fa-caret-down');
    } else
    {
        if ($("#tables_selectbox .dropdown_9 dt a").find($(".fa")).hasClass('fa-caret-down'))
        {
            $("#tables_selectbox .dropdown_9 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
            $("#tables_selectbox .dropdown_9 dd ul").slideUp('fast');
        }
        $("#tables_selectbox .dropdown_9 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');
        $("#tables_selectbox .dropdown_9 dd ul").slideUp('fast');
    }
});
$("#tables_selectbox .dropdown dd ul li button").on('click', function () {
    $("#tables_selectbox .dropdown dd ul").slideUp('fast');
    $("#tables_selectbox .dropdown dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');

});
$("#tables_selectbox .dropdown_2 dd ul li button").on('click', function () {
    $("#tables_selectbox .dropdown_2 dd ul").slideUp('fast');
    $("#tables_selectbox .dropdown_2 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');

});
$("#tables_selectbox .dropdown_3 dd ul li button").on('click', function () {
    $("#tables_selectbox .dropdown_3 dd ul").slideUp('fast');
    $("#tables_selectbox .dropdown_3 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');

});
$("#tables_selectbox .dropdown_4 dd ul li button").on('click', function () {
    $("#tables_selectbox .dropdown_4 dd ul").slideUp('fast');
    $("#tables_selectbox .dropdown_4 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');

});
$("#tables_selectbox .dropdown_6 dd ul li button").on('click', function () {
    $("#tables_selectbox .dropdown_6 dd ul").slideUp('fast');
    $("#tables_selectbox .dropdown_6 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');

});
$("#tables_selectbox .dropdown_7 dd ul li button").on('click', function () {
    $("#tables_selectbox .dropdown_7 dd ul").slideUp('fast');
    $("#tables_selectbox .dropdown_7 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');

});
$("#tables_selectbox .dropdown_8 dd ul li button").on('click', function () {
    $("#tables_selectbox .dropdown_8 dd ul").slideUp('fast');
    $("#tables_selectbox .dropdown_8 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');

});
$("#tables_selectbox .dropdown_9 dd ul li button").on('click', function () {
    $("#tables_selectbox .dropdown_9 dd ul").slideUp('fast');
    $("#tables_selectbox .dropdown_9 dt a").find($(".fa")).removeClass('fa-caret-down').addClass('fa-caret-right');

});

function getSelectedValue(id) {
    return $("#" + id).find("dt a span.value").html();
}




function goBack() {
    window.history.back()
}


$(".price_time").on('click', function () {
    $(".dropdown_price dd ul").toggle();

});





