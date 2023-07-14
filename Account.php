<?PHP
session_start();
require ('conn.php');

if (isset($_REQUEST['hour']) && isset($_REQUEST['date']) && isset($_REQUEST['Soddisfazione'])) {
    $hour = $_REQUEST['hour'];
    $date = $_REQUEST['date'];
    $Soddisfazione = $_REQUEST['Soddisfazione'];
    $query = "UPDATE appuntamento SET `Soddisfazione`='$Soddisfazione' WHERE `ora` = '$hour' AND `Dataa` = '$date'";
    $insert = mysqli_query($conn,$query);
    // mysqli_close($conn);
    if ($insert) {
    echo "<script type='text/javascript'>alert('Satisfaction added!');</script>";
    header('Refresh: 2, url = Account.php');
    }else{
        echo "<script type='text/javascript'>alert('ERROR!');</script>";
    }
}
?>



<html>
<head>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
    <title> Account </title>
</head>


<body>
        <nav class="navbar">
            <ul>
                <li><a href="Prenotazione.php">Home</a></li>
                <li><a href="Account.php">Account</a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
        </nav>
    <div class="container">
        
        
    <div class="table_box mt-5">
    <p> Your ID card is: 
    <?php 
        require('conn.php'); 
        $query = "SELECT CodCarta from cliente where email='".$_SESSION['email']."'";
        $result = $conn-> query($query);
        $row = $result->fetch_assoc();
        echo $row['CodCarta'];
    ?> 
    </p>
    <h1 class="text-center" style="padding: 40px">YOUR APOINTMENTS</h1>
    <div class='row'>
        <table class='table table-dark table-borderless'>
            <tr>
                <th>Email</th>
                <th>Date</th>
                <th>Hour</th>
                <th>Store ID</th>
                <th>On time</th>
            </tr>

        <?php
        require ('conn.php');
        $email = $_SESSION['email'];
        $query = "SELECT * from `appuntamento` WHERE `email` = '$email'";
        $result = $conn-> query($query);

        if($result-> num_rows > 0){
            while ($row = $result->fetch_assoc())
            {
                if ($row['Soddisfazione'] == NULL) {
                    $satisfaction = '<a href="Account.php?hour='. $row["ora"] .'&date='. $row["Dataa"] .'&Soddisfazione=Yes" class="btn btn-success" style="margin-right: 10px;"><i class="fa fa-check" style="padding-right: 10px;"></i>Yes</a><a href="Account.php?hour='. $row["ora"] .'&date='. $row["Dataa"] .'&Soddisfazione=No" class="btn btn-danger"><i class="fa fa-close" style="padding-right: 10px;"></i>No</a>';
                } else {
                    $satisfaction = $row['Soddisfazione'];
                }
                
                echo "<tr><td>". $row["Email"] ."<td>". $row["Dataa"] ."<td>". $row["ora"] ."<td>". $row["CodS"] ."<td class='text-center'>". $satisfaction ."</td></tr>";
            }
            echo "</table>";
        }
            $conn->close();

        ?>
        </table>      
    </div>      
    </div>
    </div>    
<body>    
</html>
