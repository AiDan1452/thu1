<?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location: logout.php");
        exit();
    }
    include('db.php');
    $ten_nv = $_SESSION['tennv'];
    $query = $_SESSION['query'];
    $con = open_database();
    $stm = $con->prepare($query);
    $stm->bind_param('s',$_SESSION['username']);
    if(!$stm->execute())
    {
        return $error ="Can not execute command";
    }
    $result = $stm->get_result();
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Trang chủ</title>
</head>
<body>
    
<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <div class="container">  
        <!-- Brand -->
        <?php
            echo '<a class="navbar-brand" href="#"> Xin chào ' .$ten_nv.'!</a>';
        ?>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> 
            <span class="navbar-toggler-icon"></span>
        </button>
        
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="reset_password.php">Reset password</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="product.php">Products</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="row justify-content-center " >
        <div class="col-md-6 col-lg-8">
    <?php 
        echo '<h3  class="Bigtitle">Demo SQL Injection</h3>';
        echo '<h5  class="title">'.$query.'</h5>'; ?>
    <table class="table" border="1" style="border-collapse: collapse; margin: auto">
        <tbody> 
            <tr class="header">
                <td>Username</td>
                <td>Password</td>
                <td>First name</td>
                <td>Last name</td>
                <td>Email</td>
            </tr>
    <?php
    while($data=$result->fetch_assoc())
    {
        echo '<tr>
                <td>'.$data['username'].'</td>
                <td>'.$data['password'].'</td>
                <td>'.$data['firstname'].'</td>
                <td>'.$data['lastname'].'</td>
                <td>'.$data['email'].'</td>
            </tr>';
    }
    ?>
        </tbody> 
    </table>
</div>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
</body>

</html>