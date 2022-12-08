<?php
session_start();

require_once "db.php";

if(isset($_SESSION['users_id'])!="") {
    header("Location: dashboard.php");
}

if (isset($_POST['login'])) {
    $users_email = mysqli_real_escape_string($conn, $_POST['users_email']);
    $users_password = mysqli_real_escape_string($conn, $_POST['users_password']);

    if(!filter_var($users_email,FILTER_VALIDATE_EMAIL)) {
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($users_password) < 6) {
        $password_error = "Password must be minimum of 6 characters";
    }  
  //  $result="SELECT * FROM `users` WHERE `users_email`=\"facultyit480@adypu.edu.in\"";
$result = "SELECT * FROM `users` WHERE `users_email`=\"facultyit480@adypu.edu.in\" AND `users_password`=md5(\"111111\")";
  //  $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "' and pass = '" . md5($password). "'");
   if(!empty($result)){
           echo header("Location: selectionpage.htm");
       if ($row = mysqli_fetch_array($result)) {
               echo "C TEST";
            $_SESSION['users_id'] = $row['users_id'];
            $_SESSION['users_name'] = $row['users_name'];
            $_SESSION['users_email'] = $row['users_email'];
            $_SESSION['users_mobile'] = $row['users_mobile'];
            header("Location: dashboard.php");
        } 
        echo "<a href='http://cvgener.infinityfreeapp.com/selectionpage.htm?'></a>";
    }else {
        $error_message = "Incorrect Email or Password!!!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WELCOME TO WEB TECHNOLOGY SESSION</title>
    <link rel="stylesheet" href="login.css">
     <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
            <div class="col-lg-10">
                <div class="page-header">
                    <br>
                    <br>
                    <br>
                    <h1>LOGIN SECTION</h1>
                </div>
                <p>Please fill all fields in the form</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class="form-group ">
                        <label>Email</label>
                        <input type="email" name="users_email" class="form-control" value="" maxlength="30" required="">
                        <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="users_password" class="form-control" value="" maxlength="8" required="">
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>  
                    
                    <input type="submit" class="btn btn-primary" name="login" value="submit">
                    <br>
                    You don't have account?<a href="registration.php" class="mt-3"><b>Click Here</b></a>
                    
                    
                </form>
            </div>
        </div>     
    </div>
</body>
</html>