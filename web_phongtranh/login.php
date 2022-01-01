<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }
    include('db.php');
    $username="";
    $password="";
    $tennv="";
    $error="";
    $con = open_database();
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        
        if(!empty($username) && !empty($password))
        {
            $query = "SELECT * FROM account2 WHERE username=
                    ?";

            $stm = $con->prepare($query);
            $stm->bind_param('s',$username);
            if(!$stm->execute())
            {
                return $error ="Can not execute command";
            }
            $results = $stm->get_result();
            if(!$results)
            {
                $error ='Lỗi thực thi SQL ';
            }
            else
            {
                    $count= $results->num_rows;
                    if($count==1)
                    {
                            $data= $results->fetch_assoc();
                            if(password_verify($password,$data['password']))
                            {
                                    $_SESSION['tennv'] = $data['lastname'].' '.$data['firstname'];
                                    $_SESSION['username'] = $username;
                                    $_SESSION['password'] = $password;
                                    $_SESSION['query'] = $query;
                                    header("Location: index.php");
                                    exit();
                            }
                            else
                            $error="Mật khẩu sai";
                    }    
                    else
                        $error="Tên đăng nhập sai";
            }
        }
    }	   
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    

	<link rel="stylesheet" href="style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Đăng nhập</title>
</head>

<body>
<div class="container" >
    <div class="row justify-content-center " >
        <div class="col-md-8 col-lg-6">
            <h3 class="text-center text-secondary mt-5 mb-3">Đăng nhập</h3>
            <form action="login.php" method="post" class="border rounded mb-5 mx-auto px-3 pt-3 bg-light" onsubmit="return validateInput()">
                <div class="form-group " >
                    <label for="username">Tên đăng nhập</label>
                    <input  value="<?= $username ?>" name="username" id="username" type="text" class="form-control input-lg" placeholder="Nhập tên đăng nhập" autofocus onclick="clearErrorMessage()">
                </div>
                <div class="form-group">
                    <label for="username">Mật khẩu</label>
                    <input name="password" id="password" type="password" class="form-control input-lg" placeholder="Nhập mật khẩu" onclick="clearErrorMessage()">
                </div>
                
                <!-- <div class="form-group custom-control custom-checkbox">
                    <input  name="remember" type="checkbox" class="custom-control-input" id="remember">
                    <label class="custom-control-label" for="remember">Remember login</label>
                </div> -->
                <div class="form-group">
                    <?php
                        if(!empty($error))
                        {
                            echo '<div class="alert alert-danger" id="errorMessage">' . $error .'</div>';
                        }
                        else{
                            echo '<div class="alert alert-danger" id="errorMessage" style="display: none;"></div>';
                        }
                    ?>
                    <div class="col text-center">
                        <button type="submit" class="btn btn-success ">Đăng nhập</button>
                    </div>              
                </div>
            </form>

        </div>
    </div>
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
</body>

</html>