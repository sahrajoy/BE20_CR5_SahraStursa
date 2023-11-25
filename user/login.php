<?php
    session_start();        //makes that you can use the data from this session all over the website till the session will be closed.

    if(isset($_SESSION["user"]) || isset($_SESSION["adm"])){
        header("Location: /BE20_CR5_SahraStursa/index.php");
    }

    require_once '../components/db_connect.php';
    require_once '../components/clean.php';

    $emailError = "";
    $passwordError = "";
    // alerts
    $updateFailure = false;
    
    if(isset($_POST["login"])) {
        $email = clean($_POST["email"]);
        $password = clean($_POST["password"]);
        $error = false;
        
        // check if email is empty
        if(empty($email)) { 
            $error = true;
            $emailError = "Please enter a email";
        } 
        // check if email is valid
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
            $error = true;
            $emailError = "Please enter a valid email";
        } 

        // check if password is empty
        if(empty($password)) {  
            $error = true;
            $passwordError = "Please enter a password";
        } 

        if(!$error) {
            $password = hash("sha256", $password); //hash crypt the password

            $sql = "SELECT * FROM `user` WHERE `user_email` = '$email' AND `user_password` = '$password'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) !== 0) {
                $row = mysqli_fetch_assoc($result);
                if($row["user_status"] === "user") {
                    // here you set var for the session so you can reach the datas in the session
                    $_SESSION["user"] = $row["user_id"]; 
                    $_SESSION["img"] = $row["user_img"];
                    header("Location: /BE20_CR5_SahraStursa/index.php");
                } else if($row["user_status"] === "adm") {
                    // here you set var for the session so you can reach the datas in the session
                    $_SESSION["adm"] = $row["user_id"]; 
                    $_SESSION["img"] = $row["user_img"];
                    header("Location: /BE20_CR5_SahraStursa/index.php");
                }
            }else  {
                $updateFailure = true;
            }
        }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt a Pet - Login</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- SweetAlert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php require_once '../components/navbar.php'; ?>
    
    <h1>Login</h1>
    <!-- test user -->
    <div class="testuser">
        <p> User  <br>
            password: 123123 <br>
            emal: testuser@test.at <br>
        </p>
        <p> Admin  <br>
            password: 123456 <br>
            emal: testadmin@test.at <br>
        </p>
    </div>

    <div class="container">
        <div class="form">
            <form method="post" >
                <label>
                    <h3>Email:</h3>
                    <input type="email" name="email" class="form-control" value="<?= $email??""; ?>">
                    <span><?= $emailError; ?></span>
                </label>
                <label>
                    <h3>Password:</h3>
                    <input type="password" name="password" class="form-control">
                    <span><?= $passwordError; ?></span>
                </label>
                <div class="buttonForm">
                    <input type="submit" value="Login" name="login" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

    <?php require_once '../components/footer.php'; ?>
   
    <!-- SweetAlert for Failure -->
    <?php if ($updateFailure): ?> 
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
            }).then(function() {
                window.location = "login.php"; 
            });
        </script>
    <?php endif; ?>
    
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>