<?php 
  require '../helpers/dbConnection.php';
  require '../helpers/functions.php';

 $id = $_GET['id']; 

 $sql = "delete from admin where AdminId = $id";
    
 $op  = DoQuery($sql);

    if($op){
    $message = ['success' => 'admin Deleted Successfully'];
    }else{
    $message = ['error' => 'Error Deleting admin'];
    }

    $_SESSION['Message'] = $message;

    header("Location: index.php");
