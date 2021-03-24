 $(document).ready(function(){
    //   $(".dropdown-trigger").dropdown();
          
          var date = new Date();
          var today = new Date();
          var dd = today.getDate();
          var mm = today.getMonth();
          var yyyy = today.getFullYear();
          
        $("#vdeparture").datepicker({
                    defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    minDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                    autoClose:true,
                    onSelect:function(da){

                       // var mydate = new Date(da);
                      // var str = mydate.toString("MMMM yyyy");
                     out_date = new Date(da.getFullYear(), da.getMonth(), da.getDate());

                        out_date.setDate(out_date.getDate() + 1);

                       $("#vreturn").datepicker({   
                          setDefaultDate:false,
                          autoClose:true,
                          // defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
                          minDate: new Date(out_date.getFullYear(), out_date.getMonth(), out_date.getDate())});

                    }
                });


 $("#vlocation").on('keyup',function(){
          word = $(this).val();
          preserve = word;
          if(word.length ==2){
          //  console.log(word.length);
            flight_city();
          }
         });

 function flight_city(){
          
          parm = $("#vlocation").val();
          search = $('#flight_city_route').val();
          
          $.get(search+'/'+parm, function(res, status){
            $('#vlocation').autocomplete({
                data: res ,
                limit:10,
                minLength:3,
               
              });
          });
         }


      });