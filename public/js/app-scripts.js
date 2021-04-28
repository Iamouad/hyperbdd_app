
$('#base_name').keyup(function(){ 
  //document.getElementById(hide_part).style.display = none;
    
  $('#hide_part').empty();
        var query = $(this).val();
        
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('list.action') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#countryList').fadeIn();  
                    $('#countryList').html(data);
          }
         });
        


    });


function incrementDownload(baseId){
    console.log(baseId)
          var CSRF_TOKEN = $('[name="_token"]').val();
          $.ajax({
              url:'/increment-download',
              type:'get',
              dataType: 'json',
               data: {'baseId': baseId, _token: CSRF_TOKEN},
              success: function (result, status) {
                  $('#downloads'+baseId).text(result.nbDownloads)
                  //location.reload()
              },
              error : function(result, status, error){
                  console.log(error)
              }
          
          })
         
      }

      function deleteBase(baseId){
          var CSRF_TOKEN =$('[name="_token"]').val();
          $.ajax({
              url:'/delete-base',
              type:'post',
              dataType: 'json',
               data: {'baseId': baseId, _token: CSRF_TOKEN},
              success: function (result, status) {
                  $('#section'+baseId).remove();
              },
              error : function(result, status, error){
                  console.log(error)
              }
          
          })
         
      }
      function changeWindow(baseId) {
        window.location.href='bases/'+baseId;
      }
