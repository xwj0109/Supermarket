<?php
session_start();
require ('conn.php');
if(isset($_REQUEST['add'])){
    $CodS = $_REQUEST['CodS'];
    $Indirizzo = $_REQUEST['Indirizzo'];
    $Ampiezza = $_REQUEST['Ampiezza'];
    $query = "INSERT INTO supermercato (`CodS`,`Indirizzo`,`Ampiezza`) VALUES ('$CodS','$Indirizzo','$Ampiezza')";
    $insert = mysqli_query($conn,$query);
    // mysqli_close($conn);
    if ($insert) {
    echo "<script type='text/javascript'>alert('Store added!');</script>";
    }else{
        echo "<script type='text/javascript'>alert('Error, Store ID is already present!');</script>";
    }
}
if(isset($_REQUEST['edit'])){
    $CodS = $_REQUEST['ed_CodS'];
    $Indirizzo = $_REQUEST['ed_Indirizzo'];
    $Ampiezza = $_REQUEST['ed_Ampiezza'];
    $query = "UPDATE supermercato SET `Indirizzo`='$Indirizzo',`Ampiezza`='$Ampiezza' WHERE `CodS` = '$CodS'";
    $insert = mysqli_query($conn,$query);
    // mysqli_close($conn);
    if ($insert) {
    echo "<script type='text/javascript'>alert('Store successfully updated!');</script>";
    }else{
        echo "<script type='text/javascript'>alert('Error, please try again!');</script>";
    }
}

if(isset($_REQUEST['delete'])){
    $CodS = $_REQUEST['d_CodS'];
    $query = "DELETE FROM supermercato WHERE `CodS` = '$CodS'";
    $insert = mysqli_query($conn,$query);
    // mysqli_close($conn);
    if ($insert) {
    echo "<script type='text/javascript'>alert('Store successfully deleted');</script>";
    }else{
        echo "<script type='text/javascript'>alert('Error, please try again!');</script>";
    }
}
$show ='';
$sql = "SELECT * FROM supermercato";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if (!empty($row)) {
        do {
            $show .= '<tr>
        <td>'.$row['CodS'].'</td>
        <td>'.$row['Indirizzo'].'</td>
        <td>'.$row['Ampiezza'].'</td>
        <td><button type="button" class="m-1 btn btn-secondary" data-toggle="modal" data-target="#editModal" onclick = "edit_data(\''.$row['CodS'].'\',\''.$row['Indirizzo'].'\',\''.$row['Ampiezza'].'\')">Edit</button><button type="button" class="m-1 btn btn-danger" data-toggle="modal" data-target="#dltModal" onclick = dlt_data(\''.$row['CodS'].'\')>Delete</button></td></td>
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
        <title> Stores </title>
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
                <h1 class="text-center">STORES</h1>
                <div class='row'>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                        Add Store
                    </button>
                    <table class='table table-dark table-borderless'>
                        <tr>
                            <th>Store ID</th>
                            <th>Address</th>
                            <th>Largeness</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add New Store</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form style="width: 90%;" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="CodS" placeholder="Enter Store ID" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Indirizzo" placeholder="Enter Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Ampiezza" placeholder="Enter Largeness" required>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Store</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form style="width: 90%;" method="POST">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="CodS" aria-describedby="emailHelp" name="ed_CodS" placeholder="Enter Supermarket ID" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Indirizzo" aria-describedby="emailHelp" name="ed_Indirizzo" placeholder="Enter Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Ampiezza" aria-describedby="emailHelp" name="ed_Ampiezza" placeholder="Enter Largeness" required>
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
                            <h5 class="modal-title" id="exampleModalLabel">Delete Store</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form style="width: 90%;" method="POST">
                                <div class="form-group">
                                    <label>Are You Sure to Delete this store?</label>
                                    <input type="hidden" class="form-control" id="d_CodS" aria-describedby="emailHelp" name="d_CodS" required>
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
                function edit_data(CodS,Indirizzo,Ampiezza) {
                    $('#CodS').val(CodS);
                    $('#Indirizzo').val(Indirizzo);
                    $('#Ampiezza').val(Ampiezza);
                }
                function dlt_data(CodS) {
                    $('#d_CodS').val(CodS);
                }
            </script>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet"> 
    </html>

    

    