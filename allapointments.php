<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Apointments list</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
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
        <section class = "banner">
           
            
        <div class="table_box mt-5">
    <h2 class="text-center" >APOINTMENTS LIST</h2>
    <div class='row'>
        <table class='table table-dark table-borderless'>
            <tr>
                <th>Email</th>
                <th>Date</th>
                <th>Hour</th>
                <th>Supermarket ID</th>
                <th>On time</th>
            </tr>

        <?php
        require ('conn.php');
        $query = "SELECT * from `appuntamento`";
        $result = $conn-> query($query);

        if($result-> num_rows > 0){
            while ($row = $result->fetch_assoc())
            {
                echo "<tr><td>". $row["Email"] ."<td>". $row["Dataa"] ."<td>". $row["ora"] ."<td>". $row["CodS"] ."<td class='text-center'>". $row["Soddisfazione"] ."</td></tr>";
            }
            echo "</table>";
        }
            $conn->close();

        ?>
        </table>      
    </div>      
    </div>
        </section>
        </div>
      
    </body>
</html>

