<?php require "config/config.php"; ?>
 <?php
    // get update variables
    if(isset($_GET['upd'])){
        $id = $_GET['upd'];
        $query = "SELECT * FROM users WHERE id=$id";
        $fire = mysqli_query($con,$query) or die("Can not fetch the data.".mysqli_error($con));
        $user = mysqli_fetch_assoc($fire);  
    }
?>
<?php
    // update data
    if(isset($_POST['btnupdate'])){
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $phone = $_POST['phone'];
        $addres = $_POST['addres'];
        $gender = $_POST['gender'];
        $education = $_POST['education'];
        $a = implode(',',$education);
        $country = $_POST['country'];
        $dob = $_POST['dob'];

        $file = $_FILES['file']['name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        //$file_store = "imagess/".$file;
        unlink("imagess/$old_imagess");
        move_uploaded_file($file_tmp_name,"imagess/$file");
       // move_uploaded_file($file_tmp_name, $file_store);


        $query = "UPDATE users SET fullname = '$fullname',email = '$email',username = '$username',password = '$password' ,
        phone = '$phone', addres='$addres', gender = '$gender', education = '$a', country = '$country', dob='$dob', file='$file' WHERE id=$id";
        $fire = mysqli_query($con,$query) or die("Can not update the data. ".mysqli_error($con));

        if($fire) header("Location:index.php");

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>  

  <title>Update Data</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">                
                <!-- Signup form -->
                <div class="col-lg-4 col-lg-offset-4">
                    <h3>Update Data</h3>
                    <hr>
                    <table Align="center" celspace="2" Border="10px">
        <form name="signup" id="signup" action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
    <tr>
        <td>fullname</td>
        <td><input type="text" value="<?php echo $user['fullname']?>" name="fullname" id="fullname" placeholder="Enter fullname"></td></tr>

        <tr>
        <td>email</td>
        <td><input type="email" value="<?php echo $user['email']?>" name="email" id="email" placeholder="Enter email"></td></tr>

        <tr>
        <td>username</td>
        <td><input type="text" value="<?php echo $user['username']?>" name="username" id="username" placeholder="Enter username"></td></tr>

            <tr>
            <td>password</td>
            <td><input type="password" name="pass" id="pass" placeholder="Enter password"></td></tr>

        <tr>
        <td>phone</td>
        <td><input type="phone" value="<?php echo $user['phone']?>" name="phone" id="phone" placeholder="Enter phone no."></td></tr>

        <tr>
        <td>address</td>
        <td><textarea name="addres" id="addres" placeholder="Enter address"><?php echo $user['addres']?></textarea></td></tr>

        <tr>
        <td>gender</td>
        <td><input type="radio" name="gender" id="gender" <?=$user['gender']=="male" ? "checked" : ""?> value="male">male 
            <input type="radio" name="gender" id="gender" <?=$user['gender']=="female" ? "checked" : ""?> value="female">female</td></tr>

            <tr>
        <td>education</td>
        <td><input type="checkbox" name="education[]"  id="education" <?=$user['education']=="bca" ? "checked" : ""?> value="bca">bca
            <input type="checkbox" name="education[]"  id="education" <?=$user['education']=="mca" ? "checked" : ""?> value="mca">mca</td></tr>

        <tr>
            <td>country</td>
            <td><select name="country" id="country">
            <option>select any one</option>
            <option <?=$user['country']=="india" ? "selected" : ""?> value="india">india</option>
            <option <?=$user['country']=="canada" ? "selected" : ""?> value="canada">canada</option>
            <option <?=$user['country']=="america" ? "selected" : ""?> value="america">america</option>
            </select></td></tr>

        <tr>
            <td>dob</td>
            <td><input value="<?php echo $user['dob']?>"  type="Date" name="dob" id="dob"></td></tr>

            <tr>
            <td>file</td>
            <td><img src="imagess/<?php echo $user['file'] ?>" height="50px" width="50px">                                    
            <input type="file" name="file" id="file"></td></tr>

        <tr><td Align="center" colspan="2">                   
        <button name="btnupdate" id="btnupdate" type="submit">Update</button></td></tr>
                
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>