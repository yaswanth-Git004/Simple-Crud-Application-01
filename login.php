<?php
    require_once('backend/dbConnection.php');
    require_once('backend/utilities.php');
    require_once('backend/errorHandler.php');
    session_start();

    if(isset($_SESSION["username"])){
        header("Location:index.php");
        exit();
    }

    $Warning = ["status" => false, "message" => ""];
    $success = ['status' => false, 'message' => ""];

    set_Success($success);

    if(isset($_POST["submit"])){
        if(!empty($_POST["username"]) && !empty($_POST["password"])){
            $username = $_POST["username"];
            $password = $_POST["password"];

            $query = "select * from users where username = :Uname";
            $bindvalues = [':Uname' => $username];
            $user=get_User($query,$bindvalues,$conn);

            if($user && password_verify($password, $user['password']) && $username === $user['username']){
                $_SESSION['username'] = $username;
                $_SESSION['userid'] = $user['id'];
                $_SESSION['userrole'] = $user['role'];
                if(isset($_SESSION)){
                    $_SESSION["successMessage"] = 'Login successfull';
                    header('Location:index.php');
                    exit;
                }   
            } else {
               error_Handler($Warning, 'invalid username or password');
            }

            $stmt = null;
            $connectingDB = null;
            
        }else{
            error_Handler($Warning, 'please enter valid credintials');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Login</title>
</head>
<body>
    <div class="main-container flex-box content-center">
        <?php 
            if($Warning["status"]){
                echo '<div class="warning-container success">
                        <p>'.$Warning["message"].'</p>
                     </div>';
            }
            if($success['status']){
                echo '<div class="warning-container success">
                        <p>'.$success['message'].'</p>
                     </div>';
            }
        ?>
        <form class="flex-box flex-col form" action="login.php" method="post">
            <input type="text" name="username" id="name" placeholder="Username">
            <input type="password" name="password" id="password" placeholder="Password">
            <div class="flex-box content-space">
                <a href="index.php">-Home-</a>
                <a href="register.php">-Register-</a>
            </div>
            <button class="btn" name="submit" type="submit">Login</button>
        </form>
    </div>

    <script>
        let success = document.querySelector(".warning-container") || null;
       
        document.querySelector("form").addEventListener("submit", function (e) {
        let username = document.getElementById("name").value.trim();
        let password = document.getElementById("password").value.trim();
        let message = null;

        if (username === "" || password === "") {
            message = "client Please enter the details";
        } else if (!/^[A-Za-z][A-Za-z ]{2,19}$/.test(username)) {
            message = "client Username must start with a letter, be 3-20 characters, and contain only letters and spaces";
        } else if (password.length > 12) {
            message = "client Password should be less than 12 characters";
        } else if (!/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
            message = "client Password must be at least 8 characters and include uppercase, lowercase, number, and special character";
        }

        if (message !== null) {
            e.preventDefault();
            if (success) {
                success.innerHTML = `<p>${message}</p>`;
                success.classList.add("success");
            } else {
                success = document.createElement("div");
                success.classList.add("warning-container", "success");
                let p = document.createElement("p");
                p.innerText = message;
                success.appendChild(p);
                document.body.prepend(success);
            }
        }
         setTimeout(() => {
                if (success) {
                    success.classList.remove("success");
                }
            }, 5000);
    });

       if(success?.classList.contains('success')){
         setTimeout(() => {
                if (success) {
                    success.classList.remove("success");
                }
            }, 3000);
       }
    </script>
</body>
</html>