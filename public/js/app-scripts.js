
var saveData = (function () {
  var a = document.createElement("a");
  document.body.appendChild(a);
  a.style = "display: none";
  return function (data, fileName) {
          blob = new Blob([data], {type: "application/zip"}),
          url = window.URL.createObjectURL(blob);
      a.href = url;
      a.download = fileName;
      a.click();
      window.URL.revokeObjectURL(url);
      document.body.removeChild(a);
  };
}());

function download(url, filename) {
  fetch(url, {
      mode: 'no-cors' /*{mode:'cors'}*/
  }).then((transfer) => {
      return transfer.blob();
  }).then((bytes) => {
      let elm = document.createElement('a');
      elm.href = URL.createObjectURL(bytes);
      elm.setAttribute('download', filename);
      elm.click()
  }).catch((error) => {
      console.log(error);
  })
}



function downloadBase(baseId){
          // var CSRF_TOKEN = $('[name="_token"]').val();
          // window.open('/download-base?baseId='+baseId, '_blank'); 
          // $('#downloads'+baseId).text(Number($('#downloads'+baseId).text())+1)

          // $.ajax({
          //     url:'/download-base',
          //     type:'get',
          //     dataType: 'text',
          //     responseType: 'application/x-zip',
          //      data: {'baseId': baseId,  _token: CSRF_TOKEN},
          //     success: function (result, status) {
          //         //$('#downloads'+baseId).text(result.nbDownloads)
          //         //location.reload()
          //         console.log(result)
          //         //saveData(result, "download.zip");
          //     },
          //     error : function(result, status, error){
          //         console.log(error)
          //     }
          
          // })
          $('body').addClass("loading");
          fetch('/download-base?baseId='+baseId, {
            mode: 'no-cors' /*{mode:'cors'}*/
        }).then((transfer) => {
            return transfer.blob();
        }).then((bytes) => {
            let elm = document.createElement('a');
            elm.href = URL.createObjectURL(bytes);
            elm.setAttribute('download', 'Database.zip');
            elm.click()
            $('#downloads'+baseId).text(Number($('#downloads'+baseId).text())+1)
            $('body').removeClass("loading");
        }).catch((error) => {
            console.log(error);
        })
         
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

      