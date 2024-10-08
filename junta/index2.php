<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Page Title</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	</head>
	<body>
		<h1>Hello, world!</h1>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script></body>

<body>
	
<?php


require_once('Config/conexionSqlServer.php'); // Include the Cconexion class


$conexion = new Cconexion();
$conn = $conexion->ConexionBD();

if (!$conn) { // Check if connection failed
    echo "Failed to connect to database.";

    // Use sqlsrv_errors() for detailed error information (if available)
    if (function_exists('sqlsrv_errors')) {
        $errors = sqlsrv_errors();
        if (isset($errors)) {
            foreach ($errors as $error) {
                echo "SQLSTATE: " . $error['SQLSTATE'] . ", code: " . $error['code'] . ", message: " . $error['message'] . "<br>";
            }
        }
    }
} else {
    // Use the $conn object for your database interactions here
    // ...

    // Close the connection (optional, recommended for long-running scripts)
    $conn = null;
}


?>
</body>







</html>