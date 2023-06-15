<?php
session_start() ;
include "db_conn.php" ;
if(isset($_POST["uname"]) && isset($_POST["password"])){
    function validate ($data){
        $data = trim($data) ; 
        $data = stripcslashes($data) ;
        $data = htmlspecialchars($data) ;
        return $data ;
    }
    $uname = validate ($_POST["uname"]) ;
    $password =  validate($_POST["password"]) ; 
    if(empty($uname)){
        header("Location: index.php?error=User name is requierd") ;
        exit() ;
    }
    else if(empty($password)){
        header("Location: index.php?error=password is requierd ") ;
        exit() ;
    }
    else {
        $sql = "SELECT * FROM users WHERE username ='$uname' and password='$password'";
        $result = mysqli_query($conn , $sql) ;
        if(mysqli_num_rows($result) == 1 ){
            $row = mysqli_fetch_assoc($result) ;
            if($row['username'] == $uname && $row['password'] == $password){
                    echo "logged in" ;
                    $_SESSION['username'] = $row['username'] ; 
                    $_SESSION['id'] = $row['id'] ; 
                    header("Location: home.php") ;
                    exit();
                }
            else {
                header("Location: index.php?error=pa1ssword is requierd ") ;
                exit() ;
            }
        }
        else{
            header("Location: index.php?error=password is requierd ") ;
            exit() ;
        }
    }
}
else {
    header("Location: index.php") ;
    exit() ;
}
?>