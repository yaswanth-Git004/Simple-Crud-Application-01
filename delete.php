<?php
require_once("backend/dbConnection.php");
session_start();
$search_element=$_GET["id"];

function Delete($query,$page,$search_element,$conn){
    try
    {
        $stmt= $conn->prepare($query);
        $stmt->bindValue(':Id',$search_element);
        $Execute=$stmt->execute();
        if($Execute)
        {
            header("Location:$page");
        }
    }
    catch(Exception $e)
    {
        echo $e;
    }
}

function userDelete($search_element,$conn){
    try
    {
       if($_SESSION['userrole']==='admin'){
            $sql = "DELETE FROM users WHERE id= :Id";
            $stmt= $conn->prepare($sql);
            $stmt->bindValue(':Id',$search_element);
            $Execute=$stmt->execute();
            if($Execute)
            {
                header("Location:dashboard/user-management.php");
            }
       }else{
            header('Location:dashboard/adminPanel.php');
       }
    }
    catch(Exception $e)
    {
        echo $e;
    }
}

if(isset($_SESSION["username"]))
{
    if(isset($_GET['delete'])){
        $delete = $_GET['delete'];
        if($delete === 'post'){
            $query = "DELETE FROM posts WHERE id= :Id";
            $page="myPosts.php";
            Delete($query,$page,$search_element,$conn);
        }elseif($delete === 'user'){
           if($_SESSION['userrole'] === 'admin'){
                $query = "DELETE FROM users WHERE id= :Id";
                $page="dashboard/user-management.php";
                Delete($query,$page,$search_element,$conn);
           }
        }else{
            $query = "DELETE FROM posts WHERE id= :Id";
            $page="dashboard/adminPanel.php";
            Delete($query,$page,$search_element,$conn);
        }
    }
}else{
    echo '<script>window.alert("please login")
        window.location.href = "/CRUD_Application/login.php"
    </script>';
   // header("Location:register.php");
}