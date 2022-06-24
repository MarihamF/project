<?php
if(!isset($_SESSION['teacherData']))
{
    header("location:/group14/schoolSystem/dashBoard/teacherLogin.php");
    exit;
}
?>