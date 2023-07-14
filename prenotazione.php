<?php 
    session_start();
    // print_r($_SESSION);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Reservation Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
        <nav class="navbar">
            <ul>
                <li><a href="Prenotazione.php">Home</a></li>
                <li><a href="Account.php">Account</a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
            </nav>    

        <section class = "banner">
            <h2>BOOK YOUR APOINTMENT NOW</h2>
            <div class = "card-container">
                <div class = "card-img">
                    <!-- image here -->
                </div>

                <div class = "card-content">
                    <h3>Reservation</h3>
                    <form method="POST" action="prenotazione.php">
                        <div class = "form-row">
                            <input type="date" name="date" required>
                            <select name = "hours" required>
                                <option value = "hour-select">Select Hour</option>
                                <option value = "8:00:00">8:00:00</option>
                                <option value = "8:15:00">8:15:00</option>
                                <option value = "8:30:00">8:30:00</option>
                                <option value = "8:45:00">8:45:00</option>
                                <option value = "9:00:00">9:00:00</option>
                                <option value = "9:15:00">9:15:00</option>
                                <option value = "9:30:00">9:30:00</option>
                                <option value = "9:45:00">9:45:00</option>
                                <option value = "10:00:00">10:00:00</option>
                                <option value = "10:15:00">10:15:00</option>
                                <option value = "10:30:00">10:30:00</option>
                                <option value = "10:45:00">10:45:00</option>
                                <option value = "11:00:00">11:00:00</option>
                                <option value = "11:15:00">11:15:00</option>
                                <option value = "11:30:00">11:30:00</option>
                                <option value = "11:45:00">11:45:00</option>
                                <option value = "12:00:00">12:00:00</option>
                                <option value = "12:15:00">12:15:00</option>
                                <option value = "12:30:00">12:30:00</option>
                                <option value = "12:45:00">12:45:00</option>
                                <option value = "13:00:00">13:00:00</option>
                                <option value = "13:15:00">13:15:00</option>
                                <option value = "13:30:00">13:30:00</option>
                                <option value = "13:45:00">13:45:00</option>
                                <option value = "14:00:00">14:00:00</option>
                                <option value = "14:15:00">14:15:00</option>
                                <option value = "14:30:00">14:30:00</option>
                                <option value = "14:45:00">14:45:00</option>
                                <option value = "15:00:00">15:00:00</option>
                                <option value = "15:15:00">15:15:00</option>
                                <option value = "15:30:00">15:30:00</option>
                                <option value = "15:45:00">15:45:00</option>
                                <option value = "16:00:00">16:00:00</option>
                                <option value = "16:15:00">16:15:00</option>
                                <option value = "16:30:00">16:30:00</option>
                                <option value = "16:45:00">16:45:00</option>
                                <option value = "17:00:00">17:00:00</option>
                                <option value = "17:15:00">17:15:00</option>
                                <option value = "17:30:00">17:30:00</option>
                                <option value = "17:45:00">17:45:00</option>
                                <option value = "18:00:00">18:00:00</option>
                                <option value = "18:15:00">18:15:00</option>
                                <option value = "18:30:00">18:30:00</option>
                                <option value = "18:45:00">18:45:00</option>
                                <option value = "19:00:00">19:00:00</option>
                                <option value = "19:15:00">19:15:00</option>
                                <option value = "19:30:00">19:30:00</option>
                                <option value = "19:45:00">19:45:00</option>
                                <option value = "20:00:00">20:00:00</option>

                            </select>
                        
                        </div>

                        <div class = "form-row">
                            <select name="location" placeholder="Location" required>
                            <option value="" selected disabled>Select Location</option>
                            <?php
                            require_once('conn.php');
                            $query = "SELECT * FROM supermercato";
                            $result = $conn->query($query);
                            while($row = $result->fetch_array())
                               {
                                $Indirizzo= $row['Indirizzo'];
                                $CodS= $row['CodS'];
                                   echo "<option value='$CodS'>".$Indirizzo." </option>";
                               }
                            ?>
                            </select>
                           
                        </div>

                        <div class = "form-row">                           
                            <input type = "submit" value = "SUBMIT" name="appointment">
                        </div>
                        
                    </form>
                </div>
            </div>
        </section>
        
    </body>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet"> 
</html>

<?php

    if (isset($_REQUEST['appointment'])) {
        
    $hour = $_POST['hours'];
    $date = $_POST['date'];
    $email = $_SESSION['email']; 
    $CodS = $_POST['location'];    

    echo $query = "INSERT INTO `Appuntamento` (ora,dataa,email,CodS) VALUES ('$hour','$date','$email','$CodS')";
    $insert = mysqli_query($conn,$query);
    // $query-> bind_param($hour,$date,$email,$CodS);    
    // $query->execute();

    if ($insert) 
    {
        echo "<script type='text/javascript'>alert('Seccesfully submitted');</script>";   
    } 
    
    else 
    {
        echo "<script type='text/javascript'>alert('Error!');</script>";   
    }
                             
             
    // $query->close();
    // $conn->close();                  
                               
    }

?>