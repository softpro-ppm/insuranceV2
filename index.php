<?php session_start(); 
    if(!empty($_SESSION['username'])){
        echo "<script>window.location.href = 'home.php';</script>";
    }
?>
<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Softpro - Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="shortcut icon" href="assets/logo.PNG">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <script type='text/javascript' src=''></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        
         * {
             margin: 0;
             padding: 0;
             box-sizing: border-box;
             font-family: 'Poppins', sans-serif
         }
        
         body {
             background: #ecf0f3
         }
        
         .wrapper {
             max-width: 350px;
             min-height: 500px;
             margin: 80px auto;
             padding: 40px 30px 30px 30px;
             background-color: #ecf0f3;
             border-radius: 15px;
             box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff
         }
        
         .logo {
             width: 80px;
             margin: auto
         }
        
         .logo img {
             width: 100%;
             height: 80px;
             object-fit: cover;
             border-radius: 50%;
             box-shadow: 0px 0px 3px #5f5f5f, 0px 0px 0px 5px #ecf0f3, 8px 8px 15px #a7aaa7, -8px -8px 15px #fff
         }
        
         .wrapper .name {
             font-weight: 600;
             font-size: 1.4rem;
             letter-spacing: 1.3px;
             padding-left: 10px;
             color: #555
         }
        
         .wrapper .form-field input {
             width: 100%;
             display: block;
             border: none;
             outline: none;
             background: none;
             font-size: 1.2rem;
             color: #666;
             padding: 10px 15px 10px 10px
         }
        
         .wrapper .form-field {
             padding-left: 10px;
             margin-bottom: 20px;
             border-radius: 20px;
             box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff
         }
        
         .wrapper .form-field .fas {
             color: #555
         }
        
         .wrapper .btn {
             box-shadow: none;
             width: 100%;
             height: 40px;
             background-color: #03A9F4;
             color: #fff;
             border-radius: 25px;
             box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
             letter-spacing: 1.3px
         }
        
         .wrapper .btn:hover {
             background-color: #039BE5
         }
        
         .wrapper a {
             text-decoration: none;
             font-size: 0.8rem;
             color: #03A9F4
         }
        
         .wrapper a:hover {
             color: #039BE5
         }
        
         @media(max-width: 380px) {
             .wrapper {
                 margin: 30px 20px;
                 padding: 40px 15px 15px 15px
             }
         }
    </style>
</head>

<body  class='snippet-body'>
    <div class="wrapper">
        <div class="logo">
            <img src="assets/logo.PNG" alt="">
        </div>
        <form class="p-3 mt-3" autocomplete="off" action="javascript:void(0);" >
            <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> 
                <input type="text" name="username" id="username" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> 
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <button id="login" class="btn mt-3">Login</button>
            <div id="alertmsg" ></div>
        </form>
    </div>
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src=''></script>
    <script type='text/Javascript'></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#login').on('click' , function() {
                var username = $('#username').val();
                var password = $('#password').val();
                if($('#username').val() == ''){
                    $('#username').css("border-color" , "red");
                    $('#username').focus();
                }else if($('#password').val() == ''){
                    $('#username').css("border-color" , "unset");
                    $('#password').css("border-color" , "red");
                    $('#password').focus();
                }else{
                    $('#username').css("border-color" , "unset");
                    $('#password').css("border-color" , "unset");
                    $.post("include/login.php",{ username:username , password:password },function(data){
                        if(data == '1'){
                        window.location.href = 'home.php';
                        }else{
                            $('#alertmsg').html('<p style="text-transform:capitalize;color: red;">please enter correct details</p>');
                        }
                    });
                    
                }
            });
        });
    </script>
</body>

</html>