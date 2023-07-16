<?php
session_start();
$conn = mysqli_connect("localhost:3305", "root", "", "savovdata");
if(isset($_POST["submit"])){
  $email = $_POST["email"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM login WHERE email = '$email'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
      echo
      "<script> alert('Успешно регистриране'); </script>";
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: admin.php");
    }
    else{
      echo
      "<script> alert('Грешна парола'); </script>";
    }
  }
  else{
    echo
    "<script> alert('Админ не е регистриран'); </script>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Логин за админ панел</title>
  <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body class="bodyForLR">
  <div class="container">
    <h2>Влез</h2>
    <form action="" method="post">
      <div class="form-group">
        <label for="email">Имейл:</label>
        <input type="text" id="email" name="email" required value="">
      </div>
      <div class="form-group">
        <label for="password">Парола:</label>
        <input type="password" id="password" name="password" required value="">
      </div>
      <div class="form-group">
        <input type="submit" id="submitBtn" name="submit" value="Влез">
      </div>
    </form>
  </div>
</body>
</html>