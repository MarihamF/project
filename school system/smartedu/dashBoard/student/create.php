<?php
include "../helpers/dbConnection.php";
include "../helpers/functions.php";
include "../helpers/checkAdminLogin.php"
$sql = "select * from class";
$classObj  = DoQuery($sql);


#server side code....
if($_SERVER['REQUEST_METHOD']=="POST")
{

    //ADDING THE DATA OF THE PARENTS 
    $name=Clean($_POST['parentname']);
    $email=Clean($_POST['parentemail']);
    $password=Clean($_POST['parentpassword']);
    $phone=Clean($_POST['parentphone']);
    $id=$_SESSION['userData']['AdminId'];
#validate name


$errors=[];
if(!Validate($name,'required'))
{
    $errors['name']="please enter a name";
}
if(!Validate($name,'char'))
{
    $errors['name']="please enter letters only";
}

#validate email
if(!Validate($email,'required'))
{
    $errors['email']="please enter an email";
}
if(!validate($email,'email')) {
    $errors['email'] = "Invalid Email";
}
#validate password
if(!Validate($password,'required'))
{
    $errors['password']="please enter a password";
}
if(!Validate($password,'max',10))
{
    $errors['password']="length of the password of the email must be less than 10 characters";
}
if(!Validate($phone,'phone'))
{
    $errors['phone']="the phone format is wrong";
}
#checking the errors
if(count($errors)>0)
{
    $_SESSION['Message'] = $errors;
}

else
{
    #saving the data in the database
    $password=md5($password);
    $sql="insert into parent (Name,Email,Password,Phone,Admin) values('$name','$email','$password','$phone',$id)";
    $op=DoQuery($sql);
    if($op)
    {

        $message = ['success' => 'parent Added Successfully'];
    }
    else
    {
        $error=['error'=>'error in adding parent'];
    }
    $_SESSION['Message'] = $message;
}

########################################################################################################################

    //ADDING THE DATA OF THE STUDENTS

    $sql="SELECT ParentId FROM parent WHERE parentId = LAST_INSERT_ID()";
    $op=DoQuery($sql);
    $data=mysqli_fetch_assoc($op);
    print_r($data);
    $name=Clean($_POST['name']);
    $email=Clean($_POST['email']);
    $password=Clean($_POST['password']);
    $phone=Clean($_POST['phone']);
    $birthDate=Clean($_POST['birthdate']);
    $grade=Clean($_POST['grade']);
    $classId=Clean($_POST['classId']);
    $id=$_SESSION['userData']['AdminId'];
    #errors...


    #validate name
    if(!Validate($name,'required'))
    {
        $errors['name']="please enter a name";
    }
    if(!Validate($name,'char'))
    {
        $errors['name']="please enter letters only";
    }

    #validate email
    if(!Validate($email,'required'))
    {
        $errors['email']="please enter an email";
    }
    if(!validate($email,'email')) {
        $errors['email'] = "Invalid Email";
    }
    #validate password
    if(!Validate($password,'required'))
    {
        $errors['password']="please enter a password";
    }
    if(!Validate($password,'max',10))
    {
        $errors['password']="length of the password of the student must be less than 10 characters";
    }
    if(!Validate($phone,'phone'))
    {
        $errors['phone']="the phone format is wrong";
    }
    #checking the errors
    if(count($errors)>0)
    {
        $_SESSION['Message'] = $errors;
    }

    else
    {
        #saving the data in the database
        $password=md5($password);
        $sql="insert into student (Name,Email,Password,Phone,Grade,BirthDate,ClassId,AdminId,ParentId) values('$name','$email','$password','$phone','$grade','$birthDate',$classId,$id,$data[ParentId])";
        $op=DoQuery($sql);
        if($op)
        {
            $message = ['success' => 'student Added Successfully'];
        }
        else
        {
            $error=['error'=>'error in adding student'];
        }
        $_SESSION['Message'] = $message;
    }

}

require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard /students</h1>
        <ol class="breadcrumb mb-4">
           
          <?php 
              Message('admin/Create');
          ?>

        </ol>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name of the student</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name of the student">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address of the student</label>
                <input type="text" class="form-control" required id="exampleInputEmail" aria-describedby="emailHelp" name="email" placeholder="Enter email of the student">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Password of the student</label>
                <input type="password" class="form-control" required id="exampleInputPassword" name="password" placeholder="Password of the student">
            </div>
            <div class="form-group">
                <label for="exampleInputPhone">Phone of the student</label>
                <input type="text" class="form-control" required id="exampleInputPhone" name="phone" placeholder="phone of the student">
            </div>
            <div class="form-group">
                <label for="exampleInputBirthDate">birthdate</label>
                <input type="date" class="form-control" required id="exampleInputBirthDate" name="birthdate" placeholder="birthdate of the student">
            </div>
            <div class="form-group">
                <label for="exampleInputGrade">grade</label>
                <input type="text" class="form-control" required id="exampleInputGrade" name="grade" placeholder="grade of the student">
            </div>
        <div class="form-group">
        <label for="exampleInputPassword">Class</label>
        <select class="form-control" required name="classId">

          <?php
          while ($data = mysqli_fetch_assoc($classObj)) {
          ?>

            <option value="<?php echo $data['ClassId']; ?>"><?php echo $data['ClassName']; ?></option>

          <?php } ?>

        </select>
      </div>
        <div class="form-group">
            <label for="exampleInputName1">Name of the parent</label>
            <input type="text" class="form-control" required id="exampleInputName1" aria-describedby="" name="parentname" placeholder="Enter Name of the parent">
        </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address of the parent</label>
                <input type="text" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="parentemail" placeholder="Enter email of the parent">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password of the parent</label>
                <input type="password" class="form-control" required id="exampleInputPassword1" name="parentpassword" placeholder="Password of the parent">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword2">Phone of the parent</label>
                <input type="text" class="form-control" required id="exampleInputPassword2" name="parentphone" placeholder="phone of the parent">
            </div>
            
        <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          </div>
</main>


<?php
require '../layouts/footer.php';
?>