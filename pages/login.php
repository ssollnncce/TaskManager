
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/colors.css">
    <link rel="stylesheet" href="../style/login-style.css">
    <link rel="stylesheet" href="../style/fonts.css">
    <title>TaskMinder.</title>
</head>
<body>
    <div class="main-container">
        <div class="logo">
            <div class="logo-image"></div>
            <h4>TaskMinder.</h4>
        </div>
        <form method="POST" id="loginform">
            <input type="text" name="login" id="login_user" required placeholder="Login">
            <div class="error">
                <p id="correctionLog">Incorrect login</p>
                <p id="emptyLog">Enter login</p>
            </div>
            <input type="password" name="password" id="password_user" required placeholder="Password">
            <div class="error">
                <p id="correctionPas">Incorrect password</p>
                <p id="emptyPas">Enter password</p>
            </div>
            <button type="submit" name="loguser">Login</button>
        </form>
    </div>
    <div class="radio-container">
        <input type="radio" name="forms" id="radlog" checked>
        <label for="radlog">LOG IN</label>
        <input type="radio" name="forms" id="radsig">
        <label for="radsig">SIGN UP</label>
    </div>
</body>
</html>

<?php
session_start();
include_once("../php/db.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (empty($_POST["login"]) || empty($_POST["password"])){
        ?> <script>
            var emptyLog = document.getElementById("emptyPas");
            var emptyPas = document.getElementById("emptyPas")
            emptyLog.style.display = "block";
            emptyPas.style.display= "block"

        </script> <?php
    }else{
        if (loginUser($login, $password)) {
            // Если пользователь успешно вошел, сохраняем логин в сессии
            $_SESSION['login'] = $login;
            header("Location: main.php"); // Перенаправляем на защищенную страницу
            exit;
        } else {
           ?><script>
            var correctionLog =document.getElementById("correctionLog");
            var correctionPas = document.getElementById("correctionPas");
            var login =document.getElementById("login_user");
            var password =document.getElementById("password_user");
            correctionLog.style.display = "block";
            correctionPas.style.display = "block";
            login.style.border = "1px solid var(--error-500)";
            password.style.border = "1px solid var(--error-500)";
           </script>
           <?php
           exit;
        }
    }
}
?>