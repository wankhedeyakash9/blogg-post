<?php

    if(session_status() == PHP_SESSION_NONE)
        session_start();

    // if(!isset($_SESSION['username']))
    // {
    //     header("Location: ./login.php");
    //     die();
    // }

    if(isset($_SESSION['username']))
    {
        require_once "./db.php";

        $result = $con -> query("select * from  users where email = '$_SESSION[username]'");
        $result = mysqli_fetch_array($result);
    }
?>

<html>

    <head>
        <title>Blog Home</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="./static/index.css">
        
        
        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
       


    </head>
    <body vlink="black">

        <div class="container-fluid">
            <div class="page-header row">

                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-6 col-xs-6 col-12" style="padding: unset;"> <h1> Blogg-Post</h1></div>
                
                <a href="./" style="text-align: center;"  class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-xs-2 col-3"><div style="color: whitesmoke;">HOME</div></a>
            

                <a href="./my_posts.php" style="text-align: center;"  class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2 col-6"><div style="color: whitesmoke;"  >MY&nbsp;POSTS</div></a>

                <?php if (!isset($_SESSION['username'])){?>

                <a href="./login.php" style="text-align: center;"  class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2 col-3"><div style="color: whitesmoke;"  >LOGIN</div></a>


                <?php } else {?>    
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2 col-3" id="username">

                        <div class="dropdown show ">
                            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $result['name']?>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="./logout.php">Log out</a>
                            
                            </div>
                        </div>
                    </div>
                <?php } ?>
             </div>    
            
        </div>
            <div class="">
                <!-- <img src="./static/about-plan.jpg" alt="" width="100%" style="    height: min-content;"> -->
                <div class="backgrd">
                    <div style="text-align: center; color: whitesmoke; text-shadow: 1px 1px black;"> 
                        <h1 style="font-size: 60px;"> WELCOME TO BLOGG-POST</h1>
                        <h4>READ, WRITE AND SHARE YOUR KNOWLEDE</h4>
                    </div>
                </div>
                <br>
                <?php 
                    if(isset($_SESSION['isadmin']))
                    {
                ?>
                        <br>
                        <a href="#active"><button class="btn btn-dark">Active Posts</button></a>
                        <a href="#deactive"><button class="btn btn-dark">Posts Pending for activation</button></a>
                        <br><hr>
                <?php }?>
                <br>
                <a name='active'></a>
                <div class="container" style="padding: 0px 8%;">
                <?php 

                 require_once "./db.php";
                 
                 $result = $con -> query("SELECT blogs.id, blogs.title,blogs.content,blogs.post_time,users.name from blogs join users on blogs.user = users.email where blogs.isactive = TRUE order by blogs.id desc  ");


                while ($r = mysqli_fetch_array($result)) 
                    { 
                        ?>
                    <div class="container blog" >
                        <a href="./post.php?id=<?php echo $r['id'] ?>"><h2> <?php echo $r['title']?></h2></a>
                        
                        <p><?php echo substr( $r['content'],0,100)?>...</p>

                        
                         <div class="postDetails">
                            posted on <?php  echo $r["post_time"] ?>
                            <br> by <?php  echo $r["name"]?>
                            <?php if(isset($_SESSION['isadmin'])){  ?>
                                <br> <a href="editpost.php?postId=<?php echo $r['id'] ?>&deactivate=true"><button class="btn btn-danger">DEACTIVATE</button></a>
                                <a href="editpost.php?postId=<?php echo $r['id'] ?>&delete=true"><button class="btn btn-danger delete-post">DELETE THIS BLOG</button></a>
                            <?php }?>    
                        </div>
                    </div>
                    <hr>
                    <?php }?>
                    </div>

                    <br>
                    <?php if(isset($_SESSION['isadmin']))
                    {?>
                    <hr>
                    <br><br>
                    <a href="#active"><button class="btn btn-dark">Active Posts</button></a>
                    <a href="#deactive"><button class="btn btn-dark">Posts Pending for activation</button></a>
                    <br><hr>

                    <a name="deactive"></a>
                    <div class="container" style="padding: 0px 8%;">
                    <?php 

                        require_once "./db.php";
                        
                        $result = $con -> query("SELECT blogs.id, blogs.title,blogs.content,blogs.post_time,users.name from blogs join users on blogs.user = users.email where blogs.isactive = FALSE order by blogs.id desc ");


                        while ($r = mysqli_fetch_array($result)) 
                            { 
                                ?>
                            <div class="container blog" >
                                <a href="./post.php?id=<?php echo $r['id'] ?>"><h2> <?php echo $r['title']?></h2></a>
                                
                                <p><?php echo substr( $r['content'],0,100)?>...</p>

                                
                                <div class="postDetails">
                                    posted on <?php  echo $r["post_time"] ?>
                                    <br> by <?php  echo $r["name"]?>
                                    <br> <a href="editpost.php?postId=<?php echo $r['id'] ?>&activate=true"><button class="btn btn-success">ACTIVATE</button></a>
                                    <a href="editpost.php?postId=<?php echo $r['id'] ?>&delete=true"><button class="btn btn-danger delete-post">DELETE THIS BLOG</button></a>
                                </div>
                            </div>
                            <hr>
                        <?php }?>
                    </div>
                            <?php }?>


                    <!-- <div style="text-align: right;">
                        <a href="#"><button class="btn btn-primary">&leftarrow; prev</button></a>
                        <a href="#"><button class="btn btn-primary"> next &rightarrow;</button></a>
                    </div> -->
            </div>


    

    </body>

    <style>


    </style>
</html>

