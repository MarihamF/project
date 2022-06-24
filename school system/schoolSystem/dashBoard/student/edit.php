<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkAdminLogin.php';
$sql = "select * from class";
$classObj  = DoQuery($sql);

################################################################################################################
# Fetch Raw Data . . . 
$id = $_GET['id'];
$sql = "select * from student where StudentId = $id ";
$op  = DoQuery($sql);
$studentData = mysqli_fetch_assoc($op);
################################################################################################################


// Logic . . .

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = Clean($_POST['name']);
    $email = Clean($_POST['email']);
    $phone = Clean($_POST['phone']);
    $grade = Clean($_POST['grade']);
    $birthdate = Clean($_POST['birthdate']);
    $classId=Clean($_POST['classId']);
    # Validate Input . . . 
    $errors = [];

    if (!Validate($name, 'required')) {
        $errors['name'] = "Field Required";
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


    if(!Validate($phone,'phone'))
    {
        $errors['phone']="the phone format is wrong";
    }


    # Check if there are any errors . . .
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } 
    else {
        // code . . . 

        $sql = "update student set Name = '$name', Email='$email', phone='$phone',Grade='$grade', BirthDate='$birthdate',ClassId=$classId  WHERE StudentId = $id";
        $op  = DoQuery($sql);

        if ($op) {
            $message = ['success' => 'student Updated Successfully'];
            $_SESSION['Message'] = $message;
            header("Location: index.php");
             exit(); // stop the script

        } else {
            $message = ['error' => 'Error Updating student , Try Again '];
            $_SESSION['Message'] = $message;
        }
    }
}



################################################################################################################


require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard /parent</h1>
        <ol class="breadcrumb mb-4">

            <?php
            Message('student/Edit');
            ?>

        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) .'?id='.$studentData['StudentId']; ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
                <label for="exampleInputName">Name of the student</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" value="<?php echo $studentData['Name'];?>" name="name" placeholder="Enter Name of the student">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address of the student</label>
                <input type="text" class="form-control" required id="exampleInputEmail" value="<?php echo $studentData['Email'];?>" aria-describedby="emailHelp" name="email" placeholder="Enter email of the student">
            </div>

            <div class="form-group">
                <label for="exampleInputPhone">Phone of the student</label>
                <input type="text" class="form-control" required id="exampleInputPhone" value="<?php echo $studentData['phone'];?>" name="phone" placeholder="phone of the student">
            </div>
            <div class="form-group">
                <label for="exampleInputBirthDate">birthdate</label>
                <input type="date" class="form-control" required id="exampleInputBirthDate" value="<?php echo $studentData['BirthDate'];?>" name="birthdate" placeholder="birthdate of the student">
            </div>
            <div class="form-group">
                <label for="exampleInputGrade">grade</label>
                <input type="text" class="form-control" required id="exampleInputGrade" value="<?php echo $studentData['Grade'];?>" name="grade" placeholder="grade of the student">
            </div>
            <div class="form-group">
        <label for="exampleInputPassword">Class</label>
        <select class="form-control" required name="classId">

          <?php
          while ($data = mysqli_fetch_assoc($classObj)) {
          ?>

<option value="<?php echo $data['ClassId']; ?>" <?php if ($data['ClassId'] == $studentData['ClassId']) {
                                                                        echo 'selected';
                                                                    }  ?>><?php echo $data['ClassName']; ?></option>

          <?php } ?>

        </select>
      </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


</main>


<?php
require '../layouts/footer.php';
?>