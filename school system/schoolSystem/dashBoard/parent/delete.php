<?php 
  require '../helpers/dbConnection.php';
  require '../helpers/functions.php';

 $id = $_GET['id']; 

 $sql = "delete from parent where ParentId = $id";
    
 $op  = DoQuery($sql);

    if($op){
    $message = ['success' => 'parent Deleted Successfully'];
    }else{
    $message = ['error' => 'Error Deleting parent'];
    }

    $_SESSION['Message'] = $message;

    header("Location: index.php");
