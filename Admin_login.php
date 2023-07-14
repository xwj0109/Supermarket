<?php
require_once('conn.php');
?>
<!-- Form-->
<html>
           
    <head>
        <title>Login Admin</title>
        <link rel="stylesheet" href="styleregister.css">
    </head>

    <body>
        <div class="user">
            <header class="user__header">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3219/logo.svg" alt="" />
                <h1 class="user__title">Welcome to the Administrator login page</h1>
            </header>
            
            <form class="form" method="POST"  action="admin_login.php" >
                <div class="form__group">
                    <input type="Text" placeholder="Username" id="Username" name="Username" class="form__input" />
                    <input type="password" placeholder="Password" name="password" class="form__input" />
                </div>
                
                <input class="btn" type="submit" value="Login" name="bt_login">
                <div class="noreg">
                     <p> If you want to login as a user<a href="login.html"> Log in </a> ! </p>
               </div>
            </form>
        </div>
    </body>

</html>
 
<?php
	if (isset($_REQUEST['bt_login'])) {
		$username = $_POST['Username'];
		$password = $_POST['password'];

	if ((strlen($username) != 0 ) && (strlen($password) != 0)){
		$query ="SELECT * FROM amministratore WHERE Username = '$username'";
		$stmt = $conn->prepare($query);
		$result = $conn->query($query);
		if ($result->num_rows == 0) {
			echo "<script type='text/javascript'>alert('Username unknown');window.location.href='http://127.0.0.1/Ennecorta/Admin_login.php';</script>";
		}
		else {
			$user_row = $result->fetch_array();
			// cifratura e verifica della password
			$password = hash ( /*Algoritrmo di criptatura */ "md5", $_POST['password']);
			if ($password == $user_row['PasswordA']) {
				echo "Password corretta: ";
				header('Location: http://127.0.0.1/Ennecorta/adminsession.php');
				// distruzione eventuale sessione
				// precedente
				session_start();
				session_unset();
				session_destroy();
				// inizializzazione nuova sessione
				session_start();
				$_SESSION['Username'] = $username;
				$_SESSION['start_time'] = time();
			}
			else 
			{
				echo "<script type='text/javascript'>alert('Wrong password');window.location.href='http://127.0.0.1/Ennecorta/Admin_login.php';</script>"; 
			}
		}
		$result->free();
		$conn->close();
	}
	else 
	{
		header('Location: http://127.0.0.1/Ennecorta/Admin_login.php');
	}
	}
?>
