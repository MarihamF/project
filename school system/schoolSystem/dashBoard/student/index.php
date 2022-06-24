<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';

#####################################################################################################################
$sql = "select * from student";
$op  = DoQuery($sql);


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
               Message('student/Display');
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
                                <th>name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>grade</th>
                                <th>birthdate</th>
                                <th>parent id</th>
                                <th>class id</th>
                                <?php if(isset($_SESSION['userData'])){?>
                                <th>Edit</th>
                                <th>Remove</th>
                                <?php }else{?>
                                    <th>Assign degree</th>
                                    <?php } ?>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>grade</th>
                                <th>birthdate</th>
                                <th>parent id</th>
                                <th>class id</th>
                                <?php if(isset($_SESSION['userData'])){?>
                                <th>Edit</th>
                                <th>Remove</th>
                                <?php }else{?>
                                    <th>Assign degree</th>
                                    <?php } ?>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php
                            # Fetch Data & display . . . 
                            while ($data = mysqli_fetch_assoc($op)) {
                            ?>

                                <tr>
                                    <td><?php echo $data['StudentId'] ?></td>
                                    <td><?php echo $data['Name'] ?></td>
                                    <td><?php echo $data['Email'] ?></td>
                                    <td><?php echo $data['phone'] ?></td>
                                    <td><?php echo $data['Grade'] ?></td>
                                    <td><?php echo $data['BirthDate'] ?></td>
                                    <td><?php echo $data['ParentId'] ?></td>
                                    <td><?php echo $data['ClassId'] ?></td>
                                    <?php if(isset($_SESSION['userData'])){?>
                                    <td> <a href='edit.php?id=<?php echo $data['StudentId'];?>' class='btn btn-primary m-r-1em'>Edit</a> </td>
                                    <td> <a href='delete.php?id=<?php echo $data['StudentId'];?>' class='btn btn-danger m-r-1em'>Delete</a> </td>
                                     <?php }else{?>
                                        <td> <a href='../degree/create.php?id=<?php echo $data['StudentId'];?>' class='btn btn-primary m-r-1em'>Assign degree</a> </td>
                                        <td> <a href='../degree/index.php?id=<?php echo $data['StudentId'];?>' class='btn btn-primary m-r-1em'>view degree</a> </td>
                                        <?php }?>
                                </tr>
                            <?php } ?>


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