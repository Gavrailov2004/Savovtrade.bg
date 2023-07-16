<?php
session_start();
$conn = mysqli_connect("localhost:3305", "root", "", "savovdata");
$id = $_GET['edit'];
if(isset($_POST['promo'])){
    $product_nPrice = $_POST['product_nPrice'];
    $product_percent = $_POST['product_percent'];
   $product_price = $_POST['product_price'];
   $product_description = $_POST['product_description'];
      $update = "UPDATE products SET price = '$product_price',nPrice = '$product_nPrice',percent = '$product_percent', description = '$product_description', Promo = 'Промоция', color = '#FF0000' WHERE id = $id";
      $upload = mysqli_query($conn,$update);
   };
   if(isset($_POST['unpromo'])){
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
       $update = "UPDATE products SET price = '$product_price',nPrice = '',percent = '', description = '$product_description', Promo = '', color = '#000000' WHERE id = $id";
       $upload = mysqli_query($conn,$update);
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb0a559e02.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <title>Админ панел</title>
</head>
<body>
<header>
    <div class="Logo"><img src="img/logo.png" alt=""></div>
                <div class="name">
                    <h2>САВОВ ОЛ ТРЕЙД ЕООД</h2><p>Най-добрата борса за вас!</p>
                </div>
        <div class="navigation">
            <ul>
                <li><a href="http://localhost/Savov_Ol_Trejd/admin.php"><span class="icon"><i class="fa-solid fa-house"></i></span><span class="title">Начално меню</span></a></li>
                <li><a href="http://localhost/Savov_Ol_Trejd/change.php"><span class="icon"><i class="fa-solid fa-toolbox"></i></span><span class="title">Промени продукти</span></a></li>
                <li><a href="http://localhost/Savov_Ol_Trejd/logout.php"><span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span><span class="title">Излез</span></a></li>
             </ul>
        </div>
    </header>
    <aside class="productPage">
<div class="admin-product-form-container">
      <?php
      
      $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Промоция</h3>
      <input type="text" class="box" name="product_description" value="<?php echo $row['description']; ?>" placeholder="Въведи описание на промоция">
      <input type="text" min="0" class="box" name="product_price" value="<?php echo $row['price']; ?>" placeholder="Въведи стара цена">
      <input type="text" min="0" class="box" name="product_nPrice" placeholder="Въведи нова цена">
      <input type="text" min="0" class="box" name="product_percent" placeholder="Въведи колко процента отстъпка">
      <input type="submit" class="btn" name="promo" value="Направи промоция">
      <input type="submit" class="btn" name="unpromo" value="Махни промоция">
      <a href="http://localhost/AdminPanel/change.php" class="btn">Върни се!</a>
   </form>
   


   <?php }; ?>

</div>
    </aside>
</body>
</html>