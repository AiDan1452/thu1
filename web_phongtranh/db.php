<?php

function open_database()
    {
	$host = '127.0.0.1'; // tên mysql server
    $user = 'root';
    $pass = '';
    $dbname = 'giuaki'; // tên databse
    $con = mysqli_connect($host, $user, $pass, $dbname);
    
    if ($con->connect_error) {
        echo '<div class="alert alert-danger">Không thể kết nối database</div>';
        die($con->connect_error);
    }
    return $con;
}
?>
