<?php require "config.php"; ?>

<?php    
    if((isset($_POST['submit']))){
        $msg ="";
        $fullname = mysqli_real_escape_string($con,trim($_POST['fullname']));
        $email = mysqli_real_escape_string($con,trim($_POST['email']));
        $username = mysqli_real_escape_string($con,trim($_POST['username']));
        $password = mysqli_real_escape_string($con,trim($_POST['password'])); 
        $phone = mysqli_real_escape_string($con,trim($_POST['phone'])); 
        $addres = mysqli_real_escape_string($con,trim($_POST['addres'])); 
        $gender = mysqli_real_escape_string($con,trim($_POST['gender'])); 
        $education = $_POST['education']; 
        $a = implode(',',$education);
        $country = mysqli_real_escape_string($con,trim($_POST['country'])); 
        $dob = mysqli_real_escape_string($con,trim($_POST['dob'])); 

        $file = $_FILES['file']['name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_store = "imagess/".$file;

        move_uploaded_file($file_tmp_name, $file_store);


        $fullname_valid = $email_valid = $password_valid = $username_valid = false;

        //Check Fullname
        if(!empty($fullname)){            
            if(strlen($fullname) > 2 && strlen($fullname) <= 30){
                if(!preg_match('/[^a-zA-Z\s]/', $fullname)){

                    // All Test Passed !!
                    $fullname_valid = true;                 

                }else { /*Invalid Characters --> */ $msg .= "Fullname can contain only alphabets <br>"; }
            } else { /* Invalid Length --> */ $msg .= "Fullname must be between 2 to 30 chars long. <br>"; }
        } else { /* Blank Input --> */ $msg .= "Fullname can not be blank !! <br>";}

        //Check Email
        if(!empty($email)){            
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){                

                    // All Test Passed !!
                    $email_valid = true;
                
            } else { /* Invalid Email --> */ $msg .= $email."is an Invalid Email Address. <br>"; }
        } else { /* Blank Input --> */ $msg .= "email can not be blank !! <br>";}


        //Check Username
        if(!empty($username)){            
            if(strlen($username) >= 4 && strlen($username) <= 15){
                if(!preg_match('/[^a-zA-Z\d_.]/', $username)){


                    $query = "SELECT username FROM users WHERE username = '$username'";
                    $fire = mysqli_query($con,$query) or die("can not fire query to select usename".mysqli_query($con));
                   
                    if(mysqli_num_rows($fire)>0){
                        $msg .= "username is not available try another !! <br>";
                    }else{
                        
                    // All Test Passed !!
                     $username_valid = true;  
                    }              

                    

                }else { /*Invalid Characters --> */ $msg .= "Username can contain alphabets,digits,underscore '_' and period '.' symbols <br>"; }
            } else { /* Invalid Length --> */ $msg .= "Username must be between 2 to 15 chars long. <br>"; }
        } else { /* Blank Input --> */ $msg .= "Username can not be blank !! <br>";}


        //Check Password
        if(!empty($password)){            
            if(strlen($password) >= 5 && strlen($password) <= 15){
                    
                    // All Test Passed !!
                    $password_valid = true;
                    $password = md5($password);                   

                
            } else { /* Invalid Length --> */ $msg .= $password." = password must be between 5 to 15 chars long. <br>"; }
        } else { /* Blank Input --> */ $msg .= "Password can not be blank !! <br>";}
               
        if($fullname_valid && $email_valid && $password_valid && $username_valid){

            $query = "INSERT INTO users(fullname,email,username,password,phone,addres,gender,education,country,dob,file) VALUES
            ('$fullname','$email','$username','$password','$phone','$addres','$gender','$a','$country','$dob','$file')";
            $fire = mysqli_query($con,$query) or die("Can not insert data into database. ".mysqli_error($con));
            if($fire) {                
                $msg = "Data Submitted to Database.";
                header("Location: ../index.php?msg=".$msg);
            }
        }else{
                header("Location: ../index.php?msg=".$msg);
        }
    }
    ?>

    <?php
        //Delete Entries
        if(isset($_GET['del'])){
            $id = $_GET['del'];
            $query = "DELETE FROM users WHERE id = $id";
            $fire = mysqli_query($con,$query) or die("Can not delete the data from database.". mysqli_error($con));
            if($fire) {
                echo "Data deleted from database";
                header("Location:../index.php");
            };
        }
    ?>