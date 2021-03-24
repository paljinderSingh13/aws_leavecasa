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
                            value: item.name,
                            info: item.key
                        }
                    }).slice(0, 10));
                }
            });
        },
        select: function(event, ui) {
            $("#"+id).val(ui.item.info);
            if (check) {
                final = el.parent('.fromp').parent('.topp').next().children('.top');
                final.children('.to').val($("#" + id).val());
                final.children('.tol').addClass('active');
            }
        }
    });
});

var nowTemp1 = new Date();
var now1 = new Date(nowTemp1.getFullYear(), nowTemp1.getMonth(), nowTemp1.getDate(), 0, 0, 0, 0);
var depart = $('#depart_o').datepicker({
    format: 'yyyy-mm-dd',
    beforeShowDay: function(date) {
        return date.valueOf() >= now1.valueOf();
    },
    autoclose: true
}).on('changeDate', function(ev) {
    if (ev.date.valueOf() > returnflight.datepicker("getDate").valueOf() || !returnflight.datepicker("getDate").valueOf()) {
        var newDate = new Date(ev.date);
        newDate.setDate(newDate.getDate());
        returnflight.datepicker("update", newDate);
    }
    $('#return')[0].focus();
});
var returnflight = $('#return').datepicker({
    format: 'yyyy-mm-dd',
    beforeShowDay: function(date) {
        if (!depart.datepicker("getDate").valueOf()) {
            return date.valueOf() >= new Date().valueOf();
        } else {
            return date.valueOf() > depart.datepicker("getDate").valueOf();
        }
    },
    autoclose: true
}).on('changeDate', function(ev) {});

//////////////////////////////Multi Flight js //////////////////////////////////////////////////////////////////

var depart1 = $('#departure').datepicker({
    format: 'yyyy-mm-dd',
    beforeShowDay: function(date) {
        return date.valueOf() >= now1.valueOf();
    },
    autoclose: true
}).on('changeDate', function(ev) {
    if (ev.date.valueOf() > returnflight1.datepicker("getDate").valueOf() || !returnflight1.datepicker("getDate").valueOf()) {
        var newDate = new Date(ev.date);
        newDate.setDate(newDate.getDate());
        returnflight1.datepicker("update", newDate);
    }
    $('#departure0')[0].focus();
});
var returnflight1 = $('#departure0').datepicker({
    format: 'yyyy-mm-dd',
    beforeShowDay: function(date) {
        if (!depart1.datepicker("getDate").valueOf()) {
            return date.valueOf() >= new Date().valueOf();
        } else {
            return date.valueOf() > depart1.datepicker("getDate").valueOf();
        }
    },
    autoclose: true
}).on('changeDate', function(ev) {});

  function LeftCloneD(value){

    var $clone = $('#LeftCloneD'+value).clone(); 
    $('#LeftDiv').html($clone);
  }


  function RightCloneD(value){

    var $clone = $('#RightCloneD'+value).clone(); 
    $('#RightDiv').html($clone);
  }

//////////////////////////////Flight js end//////////////////////////////////////////////////////////////////


//////////////////////////////Signup Login js start//////////////////////////////////////////////////////////////////
function login()
  {
    $('#login').modal('show');

  }
function signup()
  {
    $('#signup').modal('show');

  }

  $(document).on('submit', '#login', function(e) {  
    e.preventDefault();
    var email = $("#LEmail").val();
    var password = $("#Lpassword").val();
    var token =  $('input[name=_token]').val();
    
    $.ajax({

    type: 'post',    
    url:'https://leavecasa.com/login/user',
    data: { _token : token,email:email,password:password}, 
    dataType: 'JSON',
    success:function(data)
    {   
        if(data.message=='Login Success'){
         $("#loginresult").html(data.message); 
         setTimeout(function()
         { window.location.reload()}, 3000);
          
        }
        else{
          $("#loginresult").html(data.message);    
        }
    },
    error: function(data) {

      // console.log(data.responseJSON);
      $("#loginresult").html('Error'); 
     
  }

 })
  });

$(document).on('submit', '#signup', function(e) {  
    e.preventDefault();
    var username = $("#username").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var mobile = $("#mobile").val();
    var token =  $('input[name=_token]').val();
    
    $.ajax({

    type: 'post',    
    url:'https://leavecasa.com/customer/register/save',
    data: { _token : token,email:email,password:password,name:username,mobile:mobile}, 
    dataType: 'JSON',
    success:function(data)
    {     
         $("#Signresult").html(data.message);   
         setTimeout(function()
         { window.location.reload()}, 3000);     
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
     $("#Signresult").html(textStatus.errors); 
  }

 })
  });

//////////////////////////////Signup Login js end//////////////////////////////////////////////////////////////////
function getCheckedBoxes() {
  var checkboxes = document.getElementsByName('stars');
  var checkboxesChecked = [];
  for (var i=0; i<checkboxes.length; i++) {
    star = checkboxes[i].value;
    $(".cat_"+star).hide();
     if (checkboxes[i].checked) {
       $(".cat_"+star).show();
        checkboxesChecked.push(checkboxes[i]);
     }
  }
  if(checkboxesChecked.length ==0){
      $(".show_cat").show(); 
 }
  // Return the array if it is non-empty, or null
  return checkboxesChecked.length > 0 ? checkboxesChecked : null;
}


//////////////////////////////other js start//////////////////////////////////////////////////////////////////
