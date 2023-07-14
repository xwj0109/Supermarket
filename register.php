<?php
require_once ('conn.php');
?>

  <html>
   
    <head>
        <link rel="stylesheet" href="styleregister.css">
        <title>Sign up</title>
    </head>
    <body>
        <div class="user">
            <header class="user__header">
               <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3219/logo.svg" alt="" />
                <h1 class="user__title">A lightweight and simple Sign up form</h1>
            </header>
            
            <form class="form" method="POST" action="register.php">
                <div class="form__group">
                    <input type="text" placeholder="Nome" name="nome"class="form__input" />
                            
                    <input type="text" placeholder="Cognome" name="cognome"class="form__input" />
                               
                    <input type="password" placeholder="Password" name="password"class="form__input" />

                    <input type="email" placeholder="Email" name="email"class="form__input" />

                    <input type="text" placeholder="Telefono" name="telefono"class="form__input" />
                </div>
                
                <input class="btn" type="submit" value="Register" name="bt_register">
            </form>
        </div>
    </body>
  </html>


<?php

if(isset($_POST['bt_register']))
    {
        $message = "Registrazione completata con successo";
           
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $password = hash ( /*Algoritrmo di criptatura */ "md5", $_POST['password']);	
        $codcarta=rand(1000000000,9999999999);
     

        if(isset($_POST['email']))
        {
            
            $query = $conn->prepare("SELECT * From Cliente WHERE email = ?");
            $query->bind_param("s",$_POST["email"]);
            $query->execute();
            $result = $query->get_result();
            $nrows = $result->fetch_assoc(); 

            if($nrows['Email'] == null){
                $query = $conn->prepare(" INSERT INTO Cliente (Email,Passwordd,CodCarta,TelefonoC,NomeC,CognomeC) VALUES (?,?,?,?,?,?)");
                $query-> bind_param("ssisss",$email,$password,$codcarta,$telefono,$nome,$cognome);    
                $query->execute();
                $query->close();
                $conn->close();
                echo "<script type='text/javascript'>alert('Welcome $nome, here is your card ID: $codcarta');window.location.href='http://127.0.0.1/Ennecorta/login.html';</script>";   

            }
            else
            {
                echo "<script type='text/javascript'>alert('User already registered');window.location.href='http://127.0.0.1/Ennecorta/register.html';</script>"; 
            }

        }
    }
?>
