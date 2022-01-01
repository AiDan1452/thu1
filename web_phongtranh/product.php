<?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location: logout.php");
        exit();
    }
    include('db.php');
    $ten_nv = $_SESSION['tennv'];
    $con = open_database();
    $query = "Select * from product";
    $result = $con->query($query);
    $error ='';
    $message='';
    $price='';
    if(isset($_POST['findproduct']))
    {
        $price = $_POST['findproduct'];
        if(!empty($price))
        {
            if(is_numeric($price)==1)
            {
                $query_find_product = "Select * from product where price <=?";
                $stm = $con->prepare($query_find_product);
                $stm->bind_param('s',$price);
                if(!$stm->execute())
                {
                    return $error ="Can not execute command";
                }
                $list_product_found = $stm->get_result();
                if(!$list_product_found)
                {
                    die("Giá không được chứa kí tự <,',!,?,|>,");
                }
                if($list_product_found->num_rows==0)
                {
                    $message ="Không có sản phẩm phù hợp";
                }
                echo '<h5  class="title">Query: '.$query_find_product.'</h5>';
            }
            else{
                die("Vui lòng nhập giá là số!");
            }
        }
        else
            $error="Vui lòng nhập giá!";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Sản phẩm</title>
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
    <form action="product.php" method="post" style="margin:auto;max-width:300px" onsubmit ="return validateProduct()">
    <div class="input-group m-3">
        <input name="findproduct" id="findproduct" value="<?= $price ?>" type="number" class="form-control rounded" placeholder="Tìm sản phẩm theo giá" aria-label="Search"
        aria-describedby="search-addon" onclick="clearErrorMessage()"/>
        <button type="submit" class="btn btn-info">SEARCH</i></button>
    </div>
        <div class="form-group">
            <?php
                        if(!empty($error))
                        {
                            echo '<div class="alert alert-danger" id="errorMessage">' . $error .'</div>';
                        }
                        else{
                            echo '<div class="alert alert-danger" id="errorMessage" style="display: none;"></div>';
                        }
                        if(!empty($message))
                        {
                            echo '<div class="alert alert-success" id="errorMessage2">' . $message .'</div>';
                        }
            ?>            
        </div>
    </form>
<?php
if(empty($price))
{
    echo '<h5  class="title">Tất cả sản phẩm</h5>
    <table cellpadding="10" cellspacing="10" border="0" style="border-collapse: collapse; margin: auto">
    <tr class="header">
            <td>ID</td>
            <td>Image</td>
            <td>Name</td>
            <td>Price</td>
            <td>Description</td>
        </tr>';
    while($data = $result->fetch_assoc())
    {
        echo '
        <tr class="item">
            <td>'.$data['id'].'</td>
            <td><img src="images/'.$data['image'].'"></td>
            <td>'.$data['name'].'</td>
            <td>'.$data['price'].'</td>
            <td>'.$data['description'].'</td>
        </tr>';
    }
    echo
    '<tr class="control" style="text-align: right; font-weight: bold; font-size: 17px">
        <td colspan="5">
            <p>Số lượng sản phẩm: '.$result->num_rows.'</p>
        </td>
    </tr>';
}
else{
    echo '<h5  class="title">Các sản phẩm có giá dưới '.$price.'</h5>
    <table cellpadding="10" cellspacing="10" border="0" style="border-collapse: collapse; margin: auto">
    <tr class="header">
            <td>ID</td>
            <td>Image</td>
            <td>Name</td>
            <td>Price</td>
            <td>Description</td>
        </tr>';
    while($data = $list_product_found->fetch_assoc())
    {
        echo '
        <tr class="item">
            <td>'.$data['id'].'</td>
            <td><img src="images/'.$data['image'].'"></td>
            <td>'.$data['name'].'</td>
            <td>'.$data['price'].'</td>
            <td>'.$data['description'].'</td>
        </tr>';
    }
    echo
    '<tr class="control" style="text-align: right; font-weight: bold; font-size: 17px">
        <td colspan="5">
            <p>Số lượng sản phẩm: '.$list_product_found->num_rows.'</p>
        </td>
    </tr>';
}
?>
</table>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
</body>

</html>