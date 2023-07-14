

<?php
require_once('conn.php');
?>
<?php
	$email = $_POST['email'];
	$password = $_POST['password'];

	if ((strlen($email) != 0 ) && (strlen($password) != 0)){
		$query ="SELECT * FROM Cliente WHERE email = '$email'";
		$stmt = $conn->prepare($query);
		$result = $conn->query($query);
		if ($result->num_rows == 0) {  
			echo "<script type='text/javascript'>alert('$email unknown.');window.location.href=' http://127.0.0.1/Ennecorta/login.html';</script>"; 
		}
		else
		{
			$user_row = $result->fetch_array();
			// cifratura e verifica della password
			$password = hash ( /*Algoritrmo di criptatura */ "md5", $_POST['password']);
			if ($password == $user_row['Passwordd']) 
			{
				header('Location: http://127.0.0.1/Ennecorta/.php');
				// distruzione eventuale sessione
				// precedente
				session_start();
				session_unset();
				session_destroy();
				// inizializzazione nuova sessione
				session_start();
				$_SESSION['email'] = $email;
				$_SESSION['start_time'] = time();
				header('Location: http://127.0.0.1/Ennecorta/prenotazione.php');
			}
			else
			{
				echo "<script type='text/javascript'>alert('Wrong password, try again.');</script>";
			}
		}
		$result->free();
		$conn->close();
	}
	else {
		header('Location: http://127.0.0.1/Ennecorta/login.html');
	}

?>