<?php 
  require '../helpers/dbConnection.php';
  require '../helpers/functions.php';
  require '../helpers/checkAdminLogin.php';
 $id = $_GET['id']; 

 $sql = "delete Image from teacher where TeacherId = $id";
    
 $op  = DoQuery($sql);

 $data=mysqli_fetch_assoc($op);

 if(RemoveFile($data['Image'])){
  $sql = "delete  from teacher where TeacherId = $id";

  $opTeacher=DoQuery($sql);
    if($opTeacher){
    $message = ['success' => 'teacher Deleted Successfully'];
    }else{
    $message = ['error' => 'Error Deleting teacher'];
    }

    $_SESSION['Message'] = $message;

    header("Location: index.php");
  }