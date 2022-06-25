<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkTeacherLogin.php';


# Fetch teacher data.......
$id=$_SESSION['teacherData']['TeacherId'];
$teacher="select * from teacher where TeacherId=$id";
$teacherObj=DoQuery($teacher);
$teacherData=mysqli_fetch_assoc($teacherObj);
print_r($teacherData);
# Fetch parentId , studentId , subjectId. . . 
$id = $_GET['id'];
$sql = "select StudentId,ParentId,classId from student where StudentId = $id";
$op = DoQuery($sql);
$studentData = mysqli_fetch_assoc($op);

$subjects=[];

$sql1="select title,SubjectId from subject where ClassId=$studentData[classId]";
$subjectObj  = DoQuery($sql1);

#server side code....
if($_SERVER['REQUEST_METHOD']=="POST")
{
   
    $id=$_SESSION['teacherData']['TeacherId'];
    $degree=Clean($_POST['degree']);
    $subjectId=Clean($_POST['subjectId']);
    echo "hello";
    $errors=[];

    if(!Validate($degree,'degree',50))
    {
        $errors['degree']='you must enter a degree less than or equal 50';
    }
    #errors...

    #checking the errors
    if(count($errors)>0)
    {
          $_SESSION['Message'] = $errors;
    }
 
    else
    {
        
        #saving the data in the database
        $sql="insert into degree (degree,StudentId,ParentId,SubjectId,TeacherId) values($degree,$studentData[StudentId] , $studentData[ParentId] , $subjectId,$id)";
        $op=DoQuery($sql);
        if($op)
        {
            $message = ['success' => 'degree Added Successfully'];
            header('location:index.php');
        }
        else
        {
            $error=['error'=>'error in adding degree'];
        }
        $_SESSION['Message'] = $message;
    }

}




require '../layouts/header.php';
require '../layouts/sidNav.php';
require '../layouts/nav.php';

?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard /degrees</h1>
        <ol class="breadcrumb mb-4">
           
          <?php 
              Message('degree/Create');
          ?>

        </ol>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) .'?id='.$studentData['StudentId']; ?>" method="post" enctype="multipart/form-data">
<div class="form-group">
        <label for="exampleInputPassword">subject</label>
        <select class="form-control" required name="subjectId">

          <?php
          while ($data = mysqli_fetch_assoc($subjectObj)) {
          ?>
            <?php if($data['SubjectId']===$teacherData['SubjectId']){?>
            <option value="<?php echo $data['SubjectId']; ?>"><?php echo $data['title']; ?></option>
          <?php } ?>
            <?php }?>
        </select>
      </div>
        <div class="form-group">
            <label for="exampleInputName1">degree</label>
            <input type="number" class="form-control" required id="exampleInputName1" aria-describedby="" name="degree" placeholder="Enter the degree">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          </div>
          </main>
<?php
require '../layouts/footer.php';
?>