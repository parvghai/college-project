<?php
  require_once "db.php";

  if(isset($_SESSION['users_id'])!="") {
    header("Location: dashboard.php");
  }

    if (isset($_POST['signup'])) {
        $name = mysqli_real_escape_string($conn, $_POST['users_name']);
        $email = mysqli_real_escape_string($conn, $_POST['users_email']);
        $mobile = mysqli_real_escape_string($conn, $_POST['users_mobile']);
        $password = mysqli_real_escape_string($conn, $_POST['users_password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['users_cpassword']); 
        if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
            $name_error = "Name must contain only alphabets and space";
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please Enter Valid Email ID";
        }
        if(strlen($password) < 6) {
            $password_error = "Password must be minimum of 6 characters";
        }       
        if(strlen($mobile) < 10) {
            $mobile_error = "Mobile number must be minimum of 10 characters";
        }
        if($password != $cpassword) {
            $cpassword_error = "Password and Confirm Password doesn't match";
        }
        if (!$error) {
            if(mysqli_query($conn, "INSERT INTO users(users_name, users_email, users_mobile ,users_password) VALUES('" . $name . "', '" . $email . "', '" . $mobile . "', '" . md5($password) . "')")) {
             header("location: login.php");
             exit();
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WELCOME TO WEB TECHNOLOGY SESSION</title>
     <link rel="stylesheet" href="login.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav>
    <div class="menu">
      <div class="logo">
        <a href="http://cvgener.infinityfreeapp.com/">CV generator</a>
      </div>
      <ul>
        <li><a href="http://cvgener.infinityfreeapp.com/">Home</a></li>
        <li><a href="http://cvgener.infinityfreeapp.com/about.html">About</a></li>
        
  
      </ul>
    </div>
  </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-offset-2">
                <div class="page-header">
                <h1>WELCOME TO WEB TECHNOLOGY SESSION</h1>
                <br>
                    <h2>Registration Form </h2>
                </div>
                <p>Please fill all fields in the form</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="users_name" class="form-control" value="" maxlength="50" required="">
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>

                    <div class="form-group ">
                        <label>Email</label>
                        <input type="email" name="users_email" class="form-control" value="" maxlength="30" required="">
                        <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="users_mobile" class="form-control" value="" maxlength="12" required="">
                        <span class="text-danger"><?php if (isset($mobile_error)) echo $mobile_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="users_password" class="form-control" value="" maxlength="8" required="">
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>  

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="users_cpassword" class="form-control" value="" maxlength="8" required="">
                        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                    </div>

                    <input type="submit" class="btn btn-primary" name="signup" value="SUBMIT">
                    Already have a account?<a href="login.php" class="btn btn-default"><b>Login</b></a>
                </form>
            </div>
        </div>    
    </div>
</body>
</html>
