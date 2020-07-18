<?php

if(session_status() == PHP_SESSION_NONE)
    session_start();
    require_once "./db.php";

    if(( isset($_GET['postId']) && isset($_SESSION['isadmin']) ) || isset($_GET['commentId']))
    {
        $id = $_GET['postId'];
        if(isset($_GET['activate']))
            $query = "UPDATE blogs set isactive = TRUE where id=$id"; 

        elseif(isset($_GET['deactivate']))
            $query = "UPDATE blogs set isactive = FALSE where id=$id"; 
        
        elseif(isset($_GET['delete']))
            $query = "delete from blogs  where id=$id"; 
        
        elseif(isset($_GET['commentId']))
            $query = "delete from comments where id=$_GET[commentId]"; 


        require_once "./db.php";
        $con -> query($query);
        echo "<script>location.href = document.referrer</script>";
        
    }
    elseif(isset($_GET['postId']) && $_SESSION['username'] == mysqli_fetch_array($con -> query("select user from blogs where id = $_GET[postId] "))['user'] )
    {
        echo mysqli_error($con);

        $query = "delete from blogs  where id= $_GET[postId]"; 
        $con -> query($query);
        echo mysqli_error($con);    
        echo "<script>location.href = './my_posts.php'</script>";

    }
?>