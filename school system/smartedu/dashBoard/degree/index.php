<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkTeacherLogin.php';
#####################################################################################################################
$sql = "select * from degree";
$op  = DoQuery($sql);
$degreeData=mysqli_fetch_assoc($op);
/* the name of the student */
$studentId=$degreeData['StudentId'];
$sql1="select Name from student where StudentId=$studentId";
$op1=DoQuery($sql1);
$studentName=mysqli_fetch_assoc($op1);
/* the name of the subject */
$subjectId=$degreeData['SubjectId'];
$sql2="select title from subject where SubjectId=$subjectId";
$op2=DoQuery($sql2);
$subjectName=mysqli_fetch_assoc($op2);
/* the name of the teacher */
$teacherId=$degreeData['TeacherId'];
$sql3="select Name from teacher where TeacherId=teacherId";
$op3=DoQuery($sql3);
$teacherName=mysqli_fetch_assoc($op3);
/* the name of the parent */
$parentId=$degreeData['ParentId'];
$sql4="select Name from parent where ParentId=parentId";
$op4=DoQuery($sql4);
$parentName=mysqli_fetch_assoc($op4);
################################################################################################################
require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
           <?php 
               Message('degree/Display');
           ?> 
         </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name of the student</th>
                                <th>name of the subject</th>
                                <th>degree</th>
                                <th>name of the teacher</th>
                                <th>name of the parent</th>
                                <th>Edit</th>
                                <th>Delete</th>
                        </thead>
                        <tfoot>
                        <tr>
                                <th>#</th>
                                <th>name of the student</th>
                                <th>name of the subject</th>
                                <th>degree</th>
                                <th>name of the teacher</th>
                                <th>name of the parent</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>

                        <?php while($data=mysqli_fetch_assoc($op)) {?>
                                <tr>
                                    <td><?php echo $data['DegreeId']?></td>
                                    <td><?php echo $studentName['Name'] ?></td>
                                    <td><?php echo $subjectName['title'] ?></td>
                                    <td><?php echo $data['degree'] ?></td>
                                    <td><?php echo $teacherName['Name'] ?></td>
                                   <td><?php echo $parentName['Name'] ?></td> 
                                   <td> <a href='edit.php?id=<?php echo $data['DegreeId'];?>' class='btn btn-primary m-r-1em'>Edit</a> </td>
                                    <td> <a href='delete.php?id=<?php echo $data['DegreeId'];?>' class='btn btn-danger m-r-1em'>Delete</a> </td> 
                                </tr>
                        <?php }?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
require '../layouts/footer.php';
?>