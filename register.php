<?php
require_once "config/database.php";
session_start();
$db = new Database();
$pdo = $db->getConnection();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Manifest file-->
    <link rel="manifest" href="manifest.json">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                            <?php
                                if(isset($_POST['register'])){
                                    $name = $_POST['names'];
                                    $email = $_POST['email'];
                                    $password = $_POST['password'];
                                    $confirm_password = $_POST['confirm_password'];
                                    $agree = $_POST['agree'];

                                    if(isset($agree)){
                                        // data sanitation
                                        if(!empty($name) &&
                                        !empty($email) &&
                                        !empty($password) && 
                                        !empty($confirm_password)){
                                            // password validation
                                            if($confirm_password !== $password){
                                                echo '<div class="alert alert-info">Please ensure passwords match</div>';
                                            }else{
                                                // check for duplication
                                                $statement = $pdo->prepare("SELECT * FROM `users` WHERE `email`=?");
                                                $statement->execute(array($email));
                                                if($statement->rowCount() > 0){
                                                    echo '<div class="alert alert-info">User already exists</div>';
                                                }else{
                                                    $statement = $pdo->prepare("INSERT INTO `users`(`username`, `name`, `email`, `role`, `password`) VALUES (?, ?, ?, ?, ?)");
                                                    $hash = password_hash($password, PASSWORD_DEFAULT);
                                                    if($statement->execute(array("", $name, $email, "member", $hash))){
                                                        $_SESSION['user'] = $email;
                                                        header("location:index.php");
                                                        echo '<div class="alert alert-success">User registration successful</div>';
                                                    }else{
                                                        echo '<div class="alert alert-info">User registration failed</div>';
                                                    }
                                                }
                                            }

                                        }else{
                                            echo '<div class="alert alert-info">Please fill all the fields</div>';
                                        }

                                    }else{
                                        echo '<div class="alert alert-info">Please agree to terms and conditions</div>';
                                    }


                                }
                            ?>
                                <div class="form-group">
                                    <label>Full Names </label>
                                    <input class="au-input au-input--full" type="text" name="names" placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="au-input au-input--full" type="password" name="confirm_password" placeholder="Confirm Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="agree">Agree the terms and policy
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="register">register</button>
                                <!-- <div class="social-login-content">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20">register with facebook</button>
                                        <button class="au-btn au-btn--block au-btn--blue2">register with twitter</button>
                                    </div>
                                </div> -->
                            </form>
                            <div class="register-link">
                                <p>
                                    Already have account?
                                    <a href="login.html">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    
    <!-- Custom JS-->
    <script src="js/app.js"></script>

</body>

</html>
<!-- end document-->