<?php 
  require '../helpers/dbConnection.php';
  require '../helpers/functions.php';
  require '../helpers/checkAdminLogin.php';
 $id = $_GET['id']; 
$sql="select Image from subject where SubjectId=$id";
$op=DoQuery($sql);
$data=mysqli_fetch_assoc($op);
if(RemoveFile($data['Image']))
 {
$sql = "delete from subject where SubjectId = $id";
    
 $subjectOp  = DoQuery($sql);

    if($subjectOp){
    $message = ['success' => 'subject Deleted Successfully'];
    }else{
    $message = ['error' => 'Error Deleting subject'];
    }

    $_SESSION['Message'] = $message;

    header("Location: index.php");
  }