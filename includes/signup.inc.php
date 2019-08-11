<?php
if (isset($_POST['signup-submit'])) {
  
    require 'dbh.inc.php';
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($username) || empty($email) || empty($password) || empty( $passwordRepeat)) {
      headers("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username) {
        headers("Location: ../signup.php?error=invalidmailuid");
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        headers("Location: ../signup.php?error=invalidmail&uid=".$username);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        headers("Location: ../signup.php?error=invaliduid&mail=".$email);
        exit();

}
elseif ($password !==  $passwordRepeat) {
    headers("Location: ../signup.php?error=passwordCheckuid=".$username."&mail=".$email);
        exit();
}
else {

   $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
   $stmt = mysqli_stmt_init($conn);
   if (!mysqli_stmt_prepare($stmt,$sql)) {
    headers("Location: ../signup.php?error=sqlerror");
    exit();
   }
   else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        headers("Location: ../signup.php?error=usertaken&mail=".$email);
        exit();
      }
      else {
        $sql = "INSERT INTO users (uidUsers,emailUsers,pwdUsers) VALUES (?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            headers("Location: ../signup.php?error=sqlerror");
            exit();
           }
           else {
               $hashPwd = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashPwd);
            mysqli_stmt_execute($stmt);
            headers("Location: ../signup.php?signup=success");
            exit();
           }
      }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
   }
}
else {
    headers("Location: ../signup.php");
        exit();
}