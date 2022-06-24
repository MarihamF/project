<?php 
  require '../helpers/dbConnection.php';
  require '../helpers/functions.php';
  require '../helpers/checkAdminLogin.php';
 $id = $_GET['id']; 

 $sql = "delete from student where StudentId = $id";
    
 $op  = DoQuery($sql);

    if($op){
    $message = ['success' => 'student Deleted Successfully'];
    }
    else{
    $message = ['error' => 'Error Deleting student'];
    }

    $_SESSION['Message'] = $message;

    header("Location:index.php");
