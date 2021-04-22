<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HyperBdd - app</title>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="/js/vendor/jquery.ui.widget.js"></script>
        <script src="/js/jquery.iframe-transport.js"></script>
        <script src="/js/jquery.fileupload.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="/css/login.css">
        <!--<link rel="stylesheet" href="/css/register.css">-->
        <link rel="stylesheet" href="/scss/login.scss">
        <link rel="stylesheet" href="/css/business-casual.css">
        <link rel="stylesheet" href="/css/business-casual.min.css">




        <script>
        // When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
        if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
            document.getElementById("navbar").style.background = "linear-gradient(70deg, #196ba7 , #29a8c9,#7ca7d6 )";
            document.getElementById("navbar").style.transition = "background-color 200ms linear";
        } 
        else {
            document.getElementById("navbar").style.background = "rgba(0, 0, 0, 0.3)";
            document.getElementById("navbar").style.box =  "0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%)";
            document.getElementById("navbar").style.font = "300";
        }
        }
        </script>


        <style>
            @media screen and (max-width: 580px) {
        #navbar {
            background: #1C2331 !important;
            }
        }
        </style>
        </head>

       

</head>
<body class="background-picture margin-top">
    <x-menuNav></x-menuNav>
    <div >
        @yield('content')
        
    </div>
</body>
</html>

