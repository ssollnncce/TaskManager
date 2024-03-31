<?php
$host = "Localhost:3306";
$username = "root";
$password = "";
$dbname = "TaskManager";
$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn) {
    die("Connection error". mysqli_connect_error());
}

function loginUser($login, $password){
    global $conn;

    $login = mysqli_real_escape_string($conn, $login);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        return true;
    }
    else{
        return false;
    }
}
?>