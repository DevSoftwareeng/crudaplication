<?php require "config/config.php"; ?>    
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

  <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-12 "> -->
                <!-- Show Data Here -->
                <!-- <div class="col-lg-12"> -->
                    <h3>User Data</h3>
                    <hr>
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>username</th>
                            <th>password</th>
                            <th>phone</th>
                            <th>address</th>
                            <th>gender</th>
                            <th>education</th>
                            <th>country</th>
                            <th>dob</th>
                            <th>file</th>
                            
                        
                         </tr>
                        </thead>
                        <tbody>                        
                             <?php
                                $query = "SELECT * FROM users";
                                $fire = mysqli_query($con,$query) or die("Can not fetch data from database ".mysqli_error($con));
                                //if($fire) echo "We got the data from database.";

                                if(mysqli_num_rows($fire)>0){                           
                                    while($user = mysqli_fetch_assoc($fire)){ ?>                                          
                                <tr>
                                    <td><?php echo $user['id'] ?></td>
                                    <td><?php echo $user['fullname'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td><?php echo $user['username'] ?></td>                                    
                                    <td><?php echo $user['password'] ?></td>                                    
                                    <td><?php echo $user['phone'] ?></td>                                    
                                    <td><?php echo $user['addres'] ?></td>                                    
                                    <td><?php echo $user['gender'] ?></td>                                    
                                    <td><?php echo $user['education'] ?></td>                                    
                                    <td><?php echo $user['country'] ?></td>                                    
                                    <td><?php echo $user['dob'] ?></td>                                    
                                    <td><img src="imagess/<?php echo $user['file'] ?>" height="100px" width="100px"></td>                                    
                                    <td><a href="config/actions.php?del=<?php echo $user['id'] ?>"class="btn btn-sm btn-danger">Delete</a></td> 
                                    <td><a class="btn btn-sm btn-warning" href="update.php?upd=<?php echo $user['id'] ?>">Update</a></td></tr>

                                   <?php
                                    }      
                                }
                                else{ ?>
                                    <tr>
                                      <td colspan="3" class="text-center">
                                          <h2 class="text-muted">There is No Data available in the database !!</h2>
                                      </td>
                                  </tr>      
                              <?php } ?>
                        </tbody>
                    </table>
                    </div>
                 </div>





                <!-- Signup form -->
            <div class="col-lg-4 col-xs-12">
                    <h3>Signup</h3>
                    <hr>
                    <?php if(isset($_GET['msg'])) echo $_GET['msg']; ?>

                <form name="signup" id="signup" action="config/actions.php" method="POST" enctype="multipart/form-data">
                    <table Align="center" celspace="2" Border="5px">
                         <tr>
                            <td>Fullname</td>
                            <td><input  name="fullname" id="fullname" type="text" placeholder="fullname"></td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td><input name="email" id="email" type="text"  placeholder="email"></td>
                        </tr>
                            
                        <tr>
                            <td>username</td>
                            <td><input name="username" id="username" type="text"  placeholder="username"></td>
                        </tr>
                                        
                        <tr>      
                            <td>Password</td>
                            <td><input name="password" id="password" type="password"  placeholder="password" ></td>
                        </tr>
                               
                        <tr>      
                            <td>phone</td>
                            <td><input name="phone" id="phone" type="phone"  placeholder="phone no." ></td>
                        </tr>
                                
                        <tr>      
                            <td>address</td>
                            <td><textarea name="addres"></textarea></td>
                        </tr>
                               
                         <tr>
                            <td>gender</td>
                            <td><input type="radio" name="gender" id="gender" value="male">male
                                <input type="radio" name="gender" id="gender" value="female">female</td>
                        </tr>

                        <tr>
                            <td>education</td>
                            <td><input type="checkbox" name="education[]" id="education" value="bca">bca
                                <input type="checkbox" name="education[]" id="education" value="mca">mca</td>
                        </tr>

                        <tr>
                            <td>country</td>
                            <td><select name="country" id="country">
                                    <option>select country</option>
                                    <option>india</option>
                                    <option>canada</option>
                                    <option>america</option>
                                </select></td>
                        </tr>

                         <tr>
                            <td>dob</td>
                            <td><input type="date" name="dob" id="dob"></td>
                        </tr>
                        
                        <tr>
                            <td>file</td>
                            <td><input type="file" name="file" id="file"></td>
                        </tr>

                        <tr>
                            <td Align="center" colspan="2">                            
                           <button name="submit" id="submit" >Sign Up</button></td>
                        </tr>
                    </table>
                </form>
            </div>
            </div>
        </div>
    </div>
</body>
</html>