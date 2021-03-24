$(document).ready(function() {
    $(".dropdown-trigger").dropdown();
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result)
                .width(150)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
///////////////////////////////////////////////////////

var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

//hotel date
var checkin = $('#checkin').datepicker({
    beforeShowDay: function(date) {
        return date.valueOf() >= now.valueOf();
    },
    autoclose: true
}).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {
        var newDate = new Date(ev.date);
        newDate.setDate(newDate.getDate() + 1);
        checkout.datepicker("update", newDate);
    }
    $('#checkout')[0].focus();
});
var checkout = $('#checkout').datepicker({
    beforeShowDay: function(date) {
        if (!checkin.datepicker("getDate").valueOf()) {
            return date.valueOf() >= new Date().valueOf();
        } else {
            return date.valueOf() > checkin.datepicker("getDate").valueOf();
        }
    },
    autoclose: true
}).on('changeDate', function(ev) {});
/////////////////////////////////////////////////////////////////////////////////////////////////
//City Search

$("#city").on('keyup', function() {
    parm = $("#city").val();
    search = $('#city_search_route').val();
    $("#city").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: search + '/' + parm,
                type: "get",
                dataType: "json",
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.name,
                            value: item.name
                        }
                    }).slice(0, 10));
                }
            });
        },
        select: function(event, ui) {
            $("#city").val(ui.item.value);
            get_code();
        }
    });
});

function get_code() {
    name = $("#city").val();
    city_code = $('#city_code').val();
    $.get(city_code + '/' + name, function(res, status) {

        $("#code").val(res.code);
        $("#country_code").val(res.country_code);
    });
}
////////////////////////////////////////////////////////////////////////////////////////
function sum(input) {
    if (toString.call(input) !== "[object Array]")
        return false;

    var total = 0;
    for (var i = 0; i < input.length; i++) {
        if (isNaN(input[i])) {
            continue;
        }
        total += Number(input[i]);
    }
    return total;
}


function adultCount() {
    var arr = $('.adult_sel').map((i, e) => e.value).get();
    total = sum(arr);

    $("#adultCount").html(total);
}

function childCount(value) {
    var arr = $('.child_sel').map((i, e) => e.value).get();
    total = sum(arr);

    $("#childCount").html(total);
}


////////////////////////////////////////////////////////////////////////////
//Hotel search

$(document).on('click', '#search', function(e) {
    e.preventDefault();
    city = $("#city").val();
    if (city == '') {
        $("#city").addClass('red-text');
        return false;
    }

    hotel_route = $("#hotel_search_route").val();

    var data = $('form').serialize();
    $.post(hotel_route, data, function(res, status) {

    });
});
//////////////////////////////Hotel js end//////////////////////////////////////////////////////////////////


//////////////////////////////Bus js start//////////////////////////////////////////////////////////////////

$("#bus_from").on('keyup', function() {
    parm = $("#bus_from").val();
    search = $('#bus_city_source_route').val();
    $("#bus_from").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: search + '/' + parm,
                type: "get",
                dataType: "json",
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.name,
                            value: item.name
                        }
                    }).slice(0, 10));
                }
            });
        },
        select: function(event, ui) {
            $("#bus_from").val(ui.item.value);
            get_bus_city_id();
        }
    });

});

function get_bus_city_id() {
    parm = $('#bus_from').val();
    search = $('#bus_city_id_route').val();
    $.get(search + '/' + parm, function(res, status) {
        $("#bus_dep").val(res);
        get_bus_destination();
    });
}

function get_bus_destination() {
    parm = $('#bus_dep').val();
    search = $('#bus_destination').val();
    $("#bus_where").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: search + '/' + parm,
                type: "get",
                dataType: "json",
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.name,
                            value: item.name
                        }
                    }));
                }
            });
        },
        select: function(event, ui) {
            $("#bus_where").val(ui.item.value);
            get_bus_city_id_to();
        }
    });

}


function get_bus_city_id_to() {
    parm = $('#bus_where').val();
    search = $('#bus_city_id_route').val();
    $.get(search + '/' + parm, function(res, status) {
        $("#bus_arv").val(res);
    });
}

$('#bcheckin').datepicker({
    format: 'yyyy-mm-d',
    beforeShowDay: function(date) {
        return date.valueOf() >= now.valueOf();
    },
    autoclose: true
});

//////////////////////////////Bus js end//////////////////////////////////////////////////////////////////


//////////////////////////////Flight js start//////////////////////////////////////////////////////////////////

$(".flight_city").on('keyup', function() {
    check = $(this).hasClass('from');
    el = $(this);
    id = this.id;
    parm = $(this).val();
    search = $('#flight_city_route').val();
    $("#"+id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: search + '/' + parm,
                type: "get",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    response($.map(data, function(item) {
                        return {
                            label: item.name,
                            value: item.name
                        }
                    }).slice(0, 10));
                }
            });
        },
        select: function(event, ui) {
            $("#"+id).val(ui.item.value);
            if (check) {
                final = el.parent('.fromp').parent('.topp').next().children('.top');
                final.children('.to').val($("#" + id).val());
                final.children('.tol').addClass('active');
            }
        }
    });
});

$('#depart').datepicker({
    format: 'yyyy-mm-d',
    beforeShowDay: function(date) {
        return date.valueOf() >= now.valueOf();
    },
    autoclose: true
});

$('#return').datepicker({
    format: 'yyyy-mm-dd',
    beforeShowDay: function(date) {
        return date.valueOf() >= now.valueOf();
    },
    autoclose: true
});