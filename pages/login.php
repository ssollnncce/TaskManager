<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
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

        <!-- form for login -->
        <!-- <form method="POST" id="loginform">
            <input type="text" name="login" id="login_user" required placeholder="Login">
            <div class="error">
                <p id="correctionLog">Incorrect login</p>
                <p id="emptyLog">Enter login</p>
            </div>
            <input type="password" name="password" id="password_user" required placeholder="Password">
            <div class="error">
                <p id="correctionPas">Incorrect password</p>
                <p id="emptyPas">Enter password please</p>
            </div>  
            <button type="submit" name="loguser">Login</button>
        </form> -->

        <!-- form for signup -->
        <form method="POST" id="signupform" class="signup" autocomplete="off">
            <div class="alert alert-danger notif" role="alert" id="AlertSign">
                All fields must be completed!
            </div>
            <div class="alert alert-danger notif" role="alert" id="AlertSignLog">
                This login is exists!
            </div>
            <div class="alert alert-danger notif" role="alert" id="AlertSignPas">
                Paccword must be longer 8 symbols!
            </div>
            <input type="text" name="name_sig" id="user_name" placeholder="Name" class="fielsSig">
            <input type="text" name="surname_sig" id="user_surname" placeholder="Surname" class="fielsSig">
            <input type="text" name="login_sig" id="user_login_sig" placeholder="Login" class="fielsSig">
            <input type="text" name="password_sig" id="user_password_sig" placeholder="Password" class="fielsSig">
            <button type="submit" name="add_user">SIGN UP</button>
        </form>

    </div>
    <div class="radio-container">
        <input type="radio" name="forms" id="radlog" checked>
        <label for="radlog">LOG IN</label>
        <input type="radio" name="forms" id="radsig">
        <label for="radsig">SIGN UP</label>
    </div>



    <script src="../code/script.js"></script>
    <script src="../code/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
include_once("../php/db.php");

if (isset($_POST['add_user'])){
        if((empty($_POST['name_sig'])) || (empty($_POST['surname_sig'])) || (empty($_POST['login_sig'])) || (empty($_POST['password_sig']))){
            ?> <script>
                var borders = document.querySelectorAll(".fielsSig");
                var empty = document.getElementById("AlertSign")

                borders.forEach(function(border) {
                    border.style.border = "1px solid var(--error-500)";
                });
                empty.style.display = "flex";

                console.log("empty fields");

            </script><?php
        }
        else{
            if (getExist('users', 'login', $_POST['login_sig'])){
                ?>
                <script>
                    var borders = document.querySelectorAll(".fielsSig");
                    var exist = document.getElementById('AlertSignLog');

                    exist.style.display = "flex";
                    borders.forEach(function(border) {
                        border.style.border = "1px solid var(--error-500)";
                    });

                    console.log("login is exist");

                </script>
                <?php
            }
            else{
                $name = $_POST['name_sig'];
                $surname = $_POST['surname_sig'];
                $login = $_POST['login_sig'];
                $password = $_POST['password_sig'];
                addUser($name, $surname ,$login, $password);
                header("location: login.php");
            }
            
        }
}

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