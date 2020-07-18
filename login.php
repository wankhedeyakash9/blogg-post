<?php


    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(isset($_SESSION['username']))
    {
            header("Location:./");
            die();
    }

    $message = "";  
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        require_once "./db.php";
        
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];

        if(isset($_POST['signin']))
        {

            $result = $con -> query("select * from users where email= '$inputEmail' and password = '$inputPassword'");
            
            if(mysqli_num_rows($result)==0)
            {
                $result = $con -> query("select * from users where email= '$inputEmail'");
                if(mysqli_num_rows($result)==0)
                    $message = Array("This email is  not registered with us!","warning");
                else
                    $message = Array("Incorrect Password! Please Try again","danger");
            }
            else
            {
                if( (int) mysqli_fetch_array($result)['isadmin'] )
                    $_SESSION['isadmin'] = true;
    
                $_SESSION['username'] = $inputEmail;
                header("Location:./");
                die();
            }
    }
    elseif(isset($_POST['signup']))
    {
 
        $result = $con -> query("select * from users where email= '$inputEmail'");
        if(mysqli_num_rows($result)==1)
            $message = Array("This email is  already registered with us! Please sign in using your password","warning");
    
        else
        {
            $inputPhone = $_POST["inputPhone"];
            $inputName = $_POST["inputName"];
            $result = $con -> query("insert into users (name, email,phone, password) values 
                                ('$inputName','$inputEmail','$inputPhone','$inputPassword')");
            if($result)
            {
                $message = Array("You have successfully registered with us! Please sign in to continue.","success");
            }
        }
    
    }


  }


?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>Task1 SignIn</title>

        <!-- Bootstrap core CSS -->
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
        

        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>
        <!-- Custom styles for this template -->
        <link href="./static/login.css" rel="stylesheet">
    </head>


    <body class="text-center">
    
        <div class="container">
            <h1>WELCOME TO BLOGG-POST</h1>
            <form  method="post" action="login.php" class="form-signin">
        
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
                
            
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="signin">Sign in</button>
                <br>
                <p> Not registered yet! 
                    <a href="javascript:{}" class="form-toggle"> Sign Up With us </a>
                </p>

                <?php
                    if($message!="")
                    {
                ?>
                <div class="alert alert-<?php echo $message[1]?>  alert-dismissable show" role="alert">
                
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                        <?php echo $message[0] ?>
                    </div>
                <?php } ?>
            </form>
        </div>
        <div class="container" style="display: none;">
            <h1>WELCOME TO BLOGG-POST</h1>
            <form class="form-signup" method="post" action="login.php"  onsubmit=" return validate()" >
        
                <h1 class="h3 mb-3 font-weight-normal">Sign Up With Us</h1>
                
                <label for="inputName" class="sr-only">Your Name</label>
                <input type="text" id="inputName" name="inputName" class="form-control" placeholder="full name" required autofocus>            
                
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                
                <label for="inputPhone" class="sr-only">Mobile Number</label>
                <input type="text" minlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="inputPhone" name="inputPhone" class="form-control" placeholder="Phone number" required autofocus>
                
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
                
                <label for="inputCPassword" class="sr-only  ">Password</label>
                <input type="password" id="inputCPassword" name="inputCPassword" class="form-control" placeholder="Password" required>

                <div id="validation-msg"></div>

                <button class="btn btn-lg btn-primary btn-block" type="submit" name="signup">Register</button>
                <br>
                <a href="javascript:{}" class="form-toggle"> Click Here to sign in </a>


                <?php
                    if($message!="")
                    {
                ?>
                    <div class="alert alert-<?php echo $message[1]?>  alert-dismissable show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                     <?php echo $message[0] ?>
                    </div>
                <?php } ?>
            </form>
        </div>

    </body>
</html>

<script src="./static/login.js"></script>
<script>


</script>