<?php 
  require '../helpers/dbConnection.php';
  require '../helpers/functions.php';
  require '../helpers/checkAdminLogin.php';

 $id = $_GET['id']; 

 $sql = "delete from class where ClassId = $id";
    
 $op  = DoQuery($sql);

    if($op){
    $message = ['success' => 'class Deleted Successfully'];
    }else{
    $message = ['error' => 'Error Deleting class'];
    }

    $_SESSION['Message'] = $message;

    header("Location: index.php");
