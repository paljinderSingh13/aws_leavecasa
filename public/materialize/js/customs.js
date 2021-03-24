 $(document).ready(function(){
       $(".dropdown-trigger").dropdown();
          
          var date = new Date();
          var today = new Date();
          var dd = today.getDate();
          var mm = today.getMonth();
          var yyyy = today.getFullYear();
          
        $("#checkin").datepicker({
                    defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    minDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    autoClose:true,
                    onSelect:function(da){

                       // var mydate = new Date(da);
                      // var str = mydate.toString("MMMM yyyy");
                     out_date = new Date(da.getFullYear(), da.getMonth(), da.getDate());

                        out_date.setDate(out_date.getDate() + 1);

                       $("#checkout").datepicker({   
                          setDefaultDate:false,
                          autoClose:true,
                          // defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                          minDate: new Date(out_date.getFullYear(), out_date.getMonth(), out_date.getDate())});

                    }
                });

         checkin = $("#checkin").val();

         $("#depart").datepicker({
                    defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    minDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    autoClose:true,
                    onSelect:function(da){

                       // var mydate = new Date(da);
                      // var str = mydate.toString("MMMM yyyy");
                     out_date = new Date(da.getFullYear(), da.getMonth(), da.getDate());

                        out_date.setDate(out_date.getDate() + 1);

                       $("#return").datepicker({   
                          setDefaultDate:false,
                          autoClose:true,
                          // defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                          minDate: new Date(out_date.getFullYear(), out_date.getMonth(), out_date.getDate())});

                    }
                });

         depart = $("#depart").val();


           $("#bcheckin").datepicker({
                    defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    minDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    autoClose:true});
          $("#departure").datepicker({
                    defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    minDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    autoClose:true,
                    onSelect:function(da){

                     out_date = new Date(da.getFullYear(), da.getMonth(), da.getDate());

                        out_date.setDate(out_date.getDate() + 1);

                       $("#departure0").datepicker({   
                          setDefaultDate:false,
                          autoClose:true,
                          minDate: new Date(out_date.getFullYear(), out_date.getMonth(), out_date.getDate())});

                        // $("#departure1").datepicker({   
                        //   setDefaultDate:false,
                        //   autoClose:true,
                        //   minDate: new Date(out_date.getFullYear(), out_date.getMonth(), out_date.getDate())});

                        // $("#departure2").datepicker({   
                        //   setDefaultDate:false,
                        //   autoClose:true,
                        //   minDate: new Date(out_date.getFullYear(), out_date.getMonth(), out_date.getDate())});
                    }

                });


         $("#city").on('keyup',function(){

          $("#city").removeClass('red-text');
            $("#city_lable").removeClass('red-text');
            $("#city_icon").removeClass('red-text');

          word = $(this).val();
          preserve = word;
          if(word.length ==2){
            // console.log(word.length);
            put_data();
          }

         });


        $(".flight_city").on('keyup',function(){

        check = $(this).hasClass('from');
        //console.log(check);
          el = $(this);
          id = this.id;
          word = $(this).val();

          preserve = word;
          if(word.length ==2){
            // console.log(word.length);
        // parm = $("#leave").val();
          search = $('#flight_city_route').val();
          
          $.get(search+'/'+word, function(res, status){
            $("#"+id).autocomplete({
                data: res ,
                limit:10,
                minLength:3,
                onAutocomplete:function(event){
                  if(check){
                    final = el.parent('.fromp').parent('.topp').next().children('.top');
                    final.children('.to').val($("#"+id).val());
                    final.children('.tol').addClass('active');
                  }

                }
                
                
              });
          });

          }

         });


$("#bus_from").on('keyup',function(){
          
          word = $(this).val();
          if(word.length ==2){
            
            bus_from();
          }

});
$("#bus_where").on('keyup',function(){
          
          word = $(this).val();
          if(word.length ==2){
            
            bus_to();
          }

});



         $("#leave").on('keyup',function(){
          word = $(this).val();
          preserve = word;
          if(word.length ==2){
          //  console.log(word.length);
            flight_city();
          }

         });

          $("#going").on('keyup',function(){
              word = $(this).val();
              preserve = word;
              if(word.length ==2){
              //  console.log(word.length);
                arrive_city(this);
              }

         });

          

          $(".counter").characterCounter();
          
          $('.chips').chips();
         $('.chips-placeholder').chips({
            placeholder: 'Enter a tag',
            secondaryPlaceholder: '+Tag',
          });
          $('.chips-autocomplete').chips({
            autocompleteOptions: {
              data: {
                'Apple': null,
                'Microsoft': null,
                'Google': null
              },
              limit: Infinity,
              minLength: 1
            }
          });
                
                // console.log(date.getMonth()  + '/' + (date.getDate()) + '/' + (date.getFullYear()));
                $('.dr-dob').datepicker({
                    defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                yearRange : 15,
                     maxDate: new Date(date.getFullYear(), date.getMonth(), date.getDate())
                });

                
              });

        $(document).on('click','#search', function(e){
          e.preventDefault();
          city = $("#city").val();
          if(city==''){
            $("#city").addClass('red-text');
            $("#city_lable").addClass('red-text');
            $("#city_icon").addClass('red-text');

            return false;
          }

          hotel_route = $("#hotel_search_route").val();

          var data = $('form').serialize();

          // console.log(hotel_route+' '+data);
           $.post(hotel_route, data , function(res, status){
              
              // $("#result").html(res);

           });
        });

      function bus_from(){

        parm = $("#bus_from").val();
        search = $('#bus_city_source_route').val();
                
                $.get(search+'/'+parm, function(res, status){
                  $('#bus_from').autocomplete({
                      data: res ,
                      limit:10,
                      minLength:3,
                      onAutocomplete:function(event){

                         get_bus_city_id();
                        }
                    });
                });
      }

      function bus_to(){

        parm = $("#bus_where").val();
        search = $('#bus_city_source_route').val();
                
                $.get(search+'/'+parm, function(res, status){
                  $('#bus_where').autocomplete({
                      data: res ,
                      limit:10,
                      minLength:3,
                      onAutocomplete:function(event){
                         get_bus_city_id_to();
                        }
                    });
                });
      }



      function get_bus_city_id(){
        parm = $('#bus_from').val();
        parm1 = $('#bus_dep').val();
         alert(parm1);
        search = $('#bus_city_id_route').val();
          $.get(search+'/'+parm, function(res, status){
            $("#bus_dep").val(res);
          });


      }
function get_bus_city_id_to(){
        parm = $('#bus_where').val();
        search = $('#bus_city_id_route').val();
          $.get(search+'/'+parm, function(res, status){
            $("#bus_arv").val(res);
          });


      }




        function flight_city(){
          
          parm = $("#leave").val();
          search = $('#flight_city_route').val();

          
          $.get(search+'/'+parm, function(res, status){
            $('#leave').autocomplete({
                data: res ,
                limit:10,
                minLength:3,
               
              });
          });
         }

         function arrive_city(el){
          // el = this;
          parm = $("#going").val();
          search = $('#flight_city_route').val();
          
          $.get(search+'/'+parm, function(res, status){
            $('#going').autocomplete({
                data: res ,
                limit:10,
                minLength:3,
               onAutocomplete:function(event){
                 // $("#going").parent().parent().next().children('.nxt').children('.nleave').val($("#going").val());
                 // console.log(el.parents().html());
                  $("#leave_label").addClass('active');
                  $("#leave0").val($("#going").val());
                  
                }
              });
          });
         }



        function get_leave_code(){

            name = $("#leave").val();
            city_code = $('#flight_city_code_route').val();
            $.get(city_code+'/'+name, function(res, status){

             $("#from").val(res);
              // $("#country_code").val(res.country_code);
            });

         }

         function get_arrive_code(){

            name = $("#going").val();
            city_code = $('#flight_city_code_route').val();
            $.get(city_code+'/'+name, function(res, status){
              $("#to").val(res);
              // $("#country_code").val(res.country_code);
            });

         }






        function put_data(){
          parm = $("#city").val();
          search = $('#city_search_route').val();
          
          $.get(search+'/'+parm, function(res, status){
            $('#city').autocomplete({
                data: res ,
                limit:10,
                minLength:3,
                onAutocomplete:function(event){
                  get_code();
                  }
              });
          });
         }

         function get_code(){

            name = $("#city").val();
            city_code = $('#city_code').val();
            $.get(city_code+'/'+name, function(res, status){
              $("#code").val(res.code);
              $("#country_code").val(res.country_code);
            });

         }


             function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah')
                            .attr('src', e.target.result)
                            .width(150)
                            .height(200);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $('.carousel').carousel({
              fullWidth: true,
              indicators:false,      
          });
            autoplay() 
        function autoplay() { 
            $('.carousel').carousel('next'); 
            setTimeout(autoplay, 3500); 
        } 

          //    $(document).ready(function() {
          //   $('input#input_text, textarea#textarea2').characterCounter();
          // });
                
function modal_open(value)     {
$('#modal'+value).modal().modal('open'); }

function modal_detail(value)     {
$('#modal'+value).modal().modal('open'); }


function sum(input){
             
 if (toString.call(input) !== "[object Array]")
    return false;
      
            var total =  0;
            for(var i=0;i<input.length;i++)
              {                  
                if(isNaN(input[i])){
                continue;
                 }
                  total += Number(input[i]);
               }
             return total;
}


function adultCount()
{

  var arr = $('.adult_sel').map((i, e) => e.value).get();
   total = sum(arr);

   $("#adultCount").html(total);
}

function childCount(value)
{
  
  var arr = $('.child_sel').map((i, e) => e.value).get();
   total = sum(arr);

   $("#childCount").html(total);
}

  function login()
  {
     // save_method = 'login';
     $('#signup').modal().modal('close');
    $('#login').modal().modal('open');

  }
  
   function rule()
  {
     // save_method = 'signup';
     
     $('#fare_rule').modal().modal('open');
  }

   function signup()
  {
     // save_method = 'signup';
     $('#login').modal().modal('close');
    $('#signup').modal().modal('open');

  }

function login1()
  {
     $('#signup1').modal().modal('close');
    $('#login1').modal().modal('open');

  }
  function signup1()
  {
     $('#login1').modal().modal('close');
    $('#signup1').modal().modal('open');

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

      console.log(data.responseJSON);
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

  function LeftCloneD(value){

    var $clone = $('#LeftCloneD'+value).clone(); 
    $('#LeftDiv').html($clone);
  }


  function RightCloneD(value){

    var $clone = $('#RightCloneD'+value).clone(); 
    $('#RightDiv').html($clone);
  }

  function imageChnge(value){

    var path = value;
    $('.changeimg').attr('src', path);
  }


function getCheckedBoxes() {
  var checkboxes = document.getElementsByName('stars');
  var checkboxesChecked = [];
  for (var i=0; i<checkboxes.length; i++) {


    star = checkboxes[i].value;

    $(".cat_"+star).hide();
     if (checkboxes[i].checked) {

    // alert('show '+ star);
       $(".cat_"+star).show();

     // console.log(checkboxes[i].value);
        checkboxesChecked.push(checkboxes[i]);
     }
  }
  if(checkboxesChecked.length ==0){

      $(".show_cat").show(); 


 }
  // Return the array if it is non-empty, or null
  return checkboxesChecked.length > 0 ? checkboxesChecked : null;
}


 