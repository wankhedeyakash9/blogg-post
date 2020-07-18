<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!isset($_SESSION['username']))
    {
        header("Location: ./login.php");
        die();
    }

    else
    {
        require_once "./db.php";

        $result = $con -> query("select * from  users where email = '$_SESSION[username]'");
        $result = mysqli_fetch_array($result);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        require_once "./db.php";


        $title = $_POST['blog-title'];
        $content = $_POST['blog-content'];

        $blogPosted =  $con -> query("insert into blogs (title,content,user ) values ('$title','$content','$_SESSION[username]')");

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
    <body >

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
        <div class="main-content row ">
            <div class="container col-xl-5">
                <form action="" method="POST" id="form-blog">
                    <h1>Write a new blog here</h1>

                    <?php if(isset($blogPosted))
                    {
                    ?>
                        <div class="alert alert-<?php echo $blogPosted?'success':'warning' ?>  alert-dismissable show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        <?php echo $blogPosted?"Blog Posted":"Something went wrong please try later".mysqli_error($con) ?>
                        </div>
                    <?php } ?>
                    <label for="inputEmail" class="">Blog Title</label>
                    <input type="text"  placeholder="Blog Title" name="blog-title"  id="blog-title" class="form-control">
                    
                    <br>

                    <label for="inputEmail" class="">Blog Content</label> 
                    <textarea name="blog-content" id="blog-content" form="form-blog" placeholder="Blog Content" class="form-control" cols="30" rows="10"></textarea>
                    
                    <br>

                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitblog">Post Blog</button>

                </form>
            </div>
            <div class="container col-xl-7" id="myblogs">
                <h1>My Blogs </h1>

                <?php 

                    require_once "./db.php";

                    $result = $con -> query("SELECT blogs.id, blogs.title,blogs.content,blogs.post_time,blogs.isactive,users.name from blogs join users on blogs.user = users.email where user='$_SESSION[username]' order by blogs.post_time desc limit 5 ");


                    while ($r = mysqli_fetch_array($result)) 
                    { 
                        ?>
                    <div class="container blog" >
                        <a href="./post.php?id=<?php echo $r['id']?>"><h2> <?php echo $r['title']?></h2></a>
                        
                        <p><?php echo substr( $r['content'],0,100)?>...</p>
                        
                        <div class="postDetails">
                            posted on <?php  echo $r["post_time"]
                            ?>
                            <br>Status: <?php echo $r['isactive']?'active':'Pending for activation' ?>
                        </div>
                    </div>
                    <hr>
                <?php }?>
                
            </div>


        </div>
        
    </body>
<style>
    .blog
{
    border-radius: 5px;
    box-shadow: 0px 0px 5px #117a8b
}
.main-content{
    height: 90%;
    overflow: hidden;
}
</style>
</html>

