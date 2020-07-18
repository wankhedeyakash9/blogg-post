<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();


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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
             
             <div class="">
                <div class="backgrd">
                    <div style="text-align: center; color: whitesmoke; text-shadow: 1px 1px black;"> 
                        <h1 style="font-size: 60px;"> WELCOME TO BLOGG-POST</h1>
                        <h4>READ, WRITE AND SHARE YOUR KNOWLEDE</h4>
                    </div>
                </div>


                <br>
                <br>
                <div class="container">
                    <?php 
                       $id = $_GET['id'];
                        require_once "./db.php";


                        if ($_SERVER['REQUEST_METHOD'] === 'POST')
                        {
                            if(isset($_POST['editBlog']))
                            {
                                $title = addslashes($_POST['blog-title']);
                                $content = addslashes($_POST['blog-content']);
                                
                                $query = "update blogs set title ='$title', content = '$content' where id = $id";
                                
                                require_once "./db.php";

                                $updateBLog = $con -> query($query);
                                echo mysqli_error($con);
                            }
                            else
                            {
                                $comment =  $_POST['comment'];
                                $con -> query("INSERT into comments (comment, user_id ,post_id) values('$comment','$_SESSION[username]',$id) ");
                            }
                        }
                        
                        $result = mysqli_fetch_array($con -> query("SELECT blogs.id, blogs.title,blogs.content,blogs.post_time,blogs.isactive,users.name,users.email from blogs join users on blogs.user = users.email where blogs.id = $id"));
                        $isblogOwner = isset($_SESSION['username']) && $result['email'] == $_SESSION['username'] ;
                        

                    

                    ?>

                    <?php if(isset($_SESSION['username']) && $result['email']== $_SESSION['username']){ ?>
                    <div class="edit-frm">
                        <br>
                        <h2>Edit Post <div style="float: right;"><button onclick="location.reload()" class="btn btn-danger">Cancel</button></div></h2>
                        <hr>
                        <form action="./post.php?id=<?php echo $id ?>" method="POST" id="edit-form">
                            <label for="blog-title" >TITLE</label>
                            <input class="form-control" name="blog-title" type="text" value="<?php echo $result['title']?>">
                            
                            <br>
                            <label for="blog-content">BLOG CONTENT</label>
                            
                            <textarea form="edit-form" class="form-control" name="blog-content" rows="10" ><?php echo  $result['content']?></textarea>
                            <br>
                            <div style="float:right"><button class="btn btn-primary" type="submit" name="editBlog"> SAVE CHANGES </button></div>
                            <br>
                        </form>
                    </div>
                    <?php }?>
                    
                    <?php if(isset($updateBLog) && $updateBLog){?>
                        <div class="alert alert-success  alert-dismissable show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            Changes has been saved in your post    
                        </div>
                    <?php } ?>

                    <div class="container blog" >
                    

                        <div class="h2"> 
                            <?php echo $result['title']?>

                            <?php if(isset($_SESSION['username']) && $result['email']== $_SESSION['username']){ ?>
                                <div style="float: right;">
                                    <button class="btn btn-info edit-post">Edit this Post</button>
                                    <a href="editpost.php?postId=<?php echo $id ?>&delete=true"><button class="btn btn-danger delete-post">Delete this Post</button></a>
                                
                                </div>
                            <?php }?>    
                            </div>                   
                        <hr>
                        
                        <p><?php echo  $result['content']?></p>

                        
                         <div class="postDetails">
                            posted on <?php  echo $result["post_time"]?>
                            <br> by <?php  echo $result["name"]?>
                            <br>Status: <?php echo $result['isactive']?'active':'inactive' ?>
                            
                        </div>
                        <div class="container">
                            <br>
                            <br>
                            <div class="comments">
                                <h6>Comments</h6>
                                <?php
                                    $result = $con -> query("SELECT * from comments  where comments.post_id = $id");
                                    if(mysqli_num_rows($result)==0)
                                        echo "<div>No comments avalilable</div> ".mysqli_error($con);  
                                    while($r = mysqli_fetch_array($result))
                                    {
                                    ?>
                                    <div>
                                        <b><?php echo $r['user_id'] ?></b> <?php echo $r['comment'] ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php if($isblogOwner ||(isset($_SESSION['username']) && $r['user_id']==$_SESSION['username']) ){?>
                                            <a href="./editpost.php?postId=<?php echo $id?>&commentId=<?php echo $r['id']?>">Remove this comment</a>
                                        <?php }?>        
                                    </div>    
                                    
                                    
                                    <?php
                                    }
                                ?>
                            </div>
                            <br>
                            <hr>
                            <?php if(isset($_SESSION['username'])){ ?>
                            <form action="./post.php?id=<?php echo $id ?>" method="post" id="comment-form">
                                <div class="row">
                                    <textarea form="comment-form" name="comment" class="col-lg-8 form-control" maxlength="100" placeholder="Add a comment" required></textarea>
                                </div>
                                <div class="row"><button type="submit" class="col-lg-2 btn btn-primary form-control">POST</button></div>
                                    
                            </form>
                            <?php }?>
                        </div>
                    </div>


                </div>
             </div>
        </div>
    </body>
</html>
            
<style>
    .edit-frm{display: none;}
</style>
<script>
    $(".edit-post").click(function(){
        $(".edit-frm").fadeIn("very slow");
        $(".blog").fadeOut()
        $(".edit-frm").slideDown("very slow");
    })


    $(".delete-post").click(function()
    {
        if(!confirm("Are you sure wnat to delete this post?"))
            return false
    })


</script>