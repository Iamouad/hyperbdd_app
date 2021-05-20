

function downloadBase(baseId){
          var CSRF_TOKEN = $('[name="_token"]').val();
          window.open('/download-base?baseId='+baseId, '_blank'); 
          $('#downloads'+baseId).text(Number($('#downloads'+baseId).text())+1)

          // $.ajax({
          //     url:'/download-base',
          //     type:'get',
          //     dataType: 'json',
          //     responseType: 'application/x-zip',
          //      data: {'baseId': baseId,  _token: CSRF_TOKEN},
          //     success: function (result, status) {
          //         //$('#downloads'+baseId).text(result.nbDownloads)
          //         //location.reload()
          //         console.log(result)
          //     },
          //     error : function(result, status, error){
          //         console.log(error)
          //     }
          
          //})
         
      }

      function deleteBase(baseId){
          var CSRF_TOKEN =$('[name="_token"]').val();
          $('#section'+baseId).remove();
          $.ajax({
              url:'/delete-base',
              type:'post',
              dataType: 'json',
               data: {'baseId': baseId, _token: CSRF_TOKEN},
              success: function (result, status) {
              },
              error : function(result, status, error){
                  console.log(error)
              }
          
          })
         
      }
      function changeWindow(baseId) {
        window.location.href='bases/'+baseId;
      }
      function openForm() {
        document.getElementById("myForm").style.display = "block";
      }
      
      function closeForm() {
        document.getElementById("myForm").style.display = "none";
      }