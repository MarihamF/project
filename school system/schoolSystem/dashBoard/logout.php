<?php 
 require 'helpers/dbConnection.php';
 require 'helpers/functions.php';



 session_destroy(); 

 header('Location: '.url('adminLogIn.php'));

?>