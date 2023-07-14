<?php
session_start();
require ('conn.php');

if(isset($_REQUEST['add'])){
    $CodS = $_REQUEST['CodS'];
    $Reparto = $_REQUEST['Reparto'];
    $TelefonoD = $_REQUEST['TelefonoD'];
    $NomeD = $_REQUEST['NomeD'];
    $CognomeD = $_REQUEST['CognomeD'];
    $Stipendio = $_REQUEST['Stipendio'];
    $query = "INSERT INTO dipendente (`CodS`,`Reparto`,`TelefonoD`,`NomeD`,`CognomeD`,`Stipendio`) VALUES ('$CodS','$Reparto','$TelefonoD','$NomeD','$CognomeD','$Stipendio')";
    $insert = mysqli_query($conn,$query);
    // mysqli_close($conn);
    if ($insert) {
    echo "<script type='text/javascript'>alert('Employee added!');</script>";
    }else{
        echo "<script type='text/javascript'>alert('Error, please try again!');</script>";
    }
}
if(isset($_REQUEST['edit'])){
    $Matricola = $_REQUEST['ed_Matricola'];
    $Reparto = $_REQUEST['ed_Reparto'];
    $TelefonoD = $_REQUEST['ed_TelefonoD'];
    $NomeD = $_REQUEST['ed_NomeD'];
    $CognomeD = $_REQUEST['ed_CognomeD'];
    $Stipendio = $_REQUEST['ed_Stipendio'];
    $query = "UPDATE dipendente SET `Reparto`='$Reparto',`TelefonoD`='$TelefonoD',`NomeD`='$NomeD',`CognomeD`='$CognomeD',`Stipendio`='$Stipendio' WHERE `Matricola` = '$Matricola'";
    $insert = mysqli_query($conn,$query);
    // mysqli_close($conn);
    if ($insert) {
    echo "<script type='text/javascript'>alert('Employee successfully added!');</script>";
    }else{
        echo "<script type='text/javascript'>alert('Error, please try again!');</script>";
    }
}

if(isset($_REQUEST['delete'])){
    $Matricola = $_REQUEST['d_Matricola'];
    $query = "DELETE FROM dipendente WHERE `Matricola` = '$Matricola'";
    $insert = mysqli_query($conn,$query);
    // mysqli_close($conn);
    if ($insert) {
    echo "<script type='text/javascript'>alert('Employee successfully deleted!');</script>";
    }else{
        echo "<script type='text/javascript'>alert('ERROR!');</script>";
    }
}
$show ='';
$sql = "SELECT * FROM dipendente";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if (!empty($row)) {
        do {
            $show .= '<tr>
        <td>'.$row['Matricola'].'</td>
        <td>'.$row['CodS'].'</td>
        <td>'.$row['Reparto'].'</td>
        <td>'.$row['TelefonoD'].'</td>
        <td>'.$row['NomeD'].'</td>
        <td>'.$row['CognomeD'].'</td>
        <td>'.$row['Stipendio'].'</td>
        <td><button type="button" class="m-1 btn btn-secondary" data-toggle="modal" data-target="#editModal" onclick = "edit_data(\''.$row['Matricola'].'\',\''.$row['Reparto'].'\',\''.$row['TelefonoD'].'\',\''.$row['NomeD'].'\',\''.$row['CognomeD'].'\',\''.$row['Stipendio'].'\')">Edit</button><button type="button" class="m-1 btn btn-danger" data-toggle="modal" data-target="#dltModal" onclick = "dlt_data(\''.$row['Matricola'].'\')">Delete</button></td></td>
        </tr>';
        } while ($row = mysqli_fetch_assoc($result));
    }
?>



    <html>

    <head>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title> Employees </title>
    </head>


    <body>
        <nav class="navbar">
            <ul>
                <li><a href="adminsession.php">Home</a></li>
                <li><a href="allapointments.php">Apointments</a></li>
                <li><a href="employee.php">Employees</a></li>
                <li><a href="stores.php">Stores</a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
        </nav>
        <div class="container">


            <div class="table_box mt-5">
                <h1 class="text-center">EMPLOYEES</h1>
                <div class='row'>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                        Add Employee
                    </button>
                    <table class='table table-dark table-borderless'>
                        <tr>
                            <th>ID number</th>
                            <th>Store ID</th>
                            <th>Department</th>
                            <th>Phone number</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                        <?php echo $show; ?>
                    </table>
                </div>
            </div>
        </div>

        <body>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form style="width: 90%;" method="POST">
                                <div class="form-group">
                                    <select class="form-control" id="exampleFormControlSelect1" name="CodS" required>
                                    <option value="" disabled selected>Select store address</option>
                                    <?php
                                    $sql1 = "SELECT * FROM supermercato";
                                    $result1 = mysqli_query($conn,$sql1);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    if (!empty($row1)) {
                                        do {
                                            echo '<option value="'.$row1['CodS'].'">'.$row1['Indirizzo'].'</option>';
                                        } while ($row1 = mysqli_fetch_assoc($result1));
                                    }else{
                                        echo '<option disabled value="">No Data Present!</option>';
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Reparto" placeholder="Enter Department" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="TelefonoD" placeholder="Enter Phone number" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="NomeD" placeholder="Enter employee's name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="CognomeD" placeholder="Enter employee's surname" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Stipendio" placeholder="Enter salary" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="add">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form style="width: 90%;" method="POST">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="Matricola" aria-describedby="emailHelp" name="ed_Matricola" placeholder="Enter Store ID" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Reparto" aria-describedby="emailHelp" name="ed_Reparto" placeholder="Enter Department" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="TelefonoD" aria-describedby="emailHelp" name="ed_TelefonoD" placeholder="Enter Phone Number" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="NomeD" aria-describedby="emailHelp" name="ed_NomeD" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="CognomeD" aria-describedby="emailHelp" name="ed_CognomeD" placeholder="Enter Surname" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="Stipendio" aria-describedby="emailHelp" name="ed_Stipendio" placeholder="Enter Salary" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="edit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="dltModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form style="width: 90%;" method="POST">
                                <div class="form-group">
                                    <label>Are You Sure to Delete this Employee?</label>
                                    <input type="hidden" class="form-control" id="d_Matricola" aria-describedby="emailHelp" name="d_Matricola" required>
                                </div>
                                
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary" name="delete">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                function edit_data(Matricola,Reparto,TelefonoD,NomeD,CognomeD,Stipendio) {
                    $('#Matricola').val(Matricola);
                    $('#Reparto').val(Reparto);
                    $('#TelefonoD').val(TelefonoD);
                    $('#NomeD').val(NomeD);
                    $('#CognomeD').val(CognomeD);
                    $('#Stipendio').val(Stipendio);
                }
                function dlt_data(Matricola) {
                    $('#d_Matricola').val(Matricola);
                }
            </script>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,100&display=swap" rel="stylesheet">
    </html>