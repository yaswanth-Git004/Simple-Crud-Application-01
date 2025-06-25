<?php 
require_once("backend/dbConnection.php");
require_once("backend/utilities.php");
require_once("backend/errorHandler.php");
session_start();
$Warning = ["status" => false, "message" => ""];
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if((!empty($_POST["username"])&&!empty($_POST["password"]))&&!empty($_POST["cpassword"]))
    {
        try{
            $username=$_POST["username"];
            $password=$_POST["password"];
            $cpassword = $_POST["cpassword"];
            $usernameError = user_Validation($username);
            $passwordError = password_Validation($password);
            // $cpassword=$_POST["cpassword"];
            if($usernameError){
            error_Handler($Warning, $usernameError);
            }elseif($passwordError){
            error_Handler($Warning, $passwordError);
            }elseif($password===$cpassword){
                $query = "select * from users where username = :Uname";
                $bindvalues = [':Uname' => $username];
                $data=get_User($query,$bindvalues,$conn);
                
                if($data && $username===$data["username"]){
                    error_Handler($Warning,'User alredy exists');
                }else{
                    $sql = "INSERT INTO users(username,password)VALUES(:Uname,:Password)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':Uname',$username);
                    $stmt->bindValue(':Password',hash_password($password));
                    $Execute=$stmt->execute();
                    if($Execute)
                    {
                        $_SESSION["successMessage"]= "user registered successfully";
                        header("Location:login.php");
                    }
                }
            }else{
                error_Handler($Warning,'passwords do not match');
            }
        }
        catch (Exception $e) 
        {
           error_Handler($Warning, $e);
        }
    }else{
        if(empty($_POST["username"])){
            error_Handler($Warning, "please enter username");           
        }
        elseif(empty($_POST["password"])){
            error_Handler($Warning,"please enter password");         
        }
        elseif(empty($_POST["cpassword"])){
            error_Handler($Warning, "please confirm password");         
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Register</title>
</head>
<body>
    <div class="main-container flex-box content-center">
        <?php 
            if($Warning["status"]){
                echo '<div class="warning-container success">
                        <p>'.$Warning["message"].'</p>
                     </div>';
            }
        ?>
        <form class="flex-box flex-col form" id="form" action="register.php" method="post">
            <input type="text" name="username" id="name" placeholder="Username" >
            <input type="password" name="password" id="password" placeholder="Password" >
            <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" >
            <div class="flex-box content-space">
                <a href="index.php">-Home-</a>
                <a href="login.php">-Login-</a>
            </div>
            <button class="btn" type="submit" name="submit">Register</button>
        </form>
    </div>

    <script>
        let success = document.querySelector(".warning-container") || null;
       
        document.getElementById("form").addEventListener("submit", function(e){
        console.log("Hello");
        // e.preventDefault();
        let username = document.getElementById("name").value.trim();
        let password = document.getElementById("password").value.trim();
        let cpassword = document.getElementById("cpassword").value.trim();
        let message = null;

        if (username === "" || password === "" || cpassword === "") {
            message = "client Please enter the details";
        } else if (!/^[A-Za-z][A-Za-z ]{2,19}$/.test(username)) {
            message = "client Username must start with a letter, be 3-20 characters, and contain only letters and spaces";
        } else if (password.length > 12) {
            message = "client Password should be less than 12 characters";
        } else if (!/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
            message = "client Password must be at least 8 characters and include uppercase, lowercase, number, and special character";
        }else if(cpassword !== password){
            message = "client passwords do not match"
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
