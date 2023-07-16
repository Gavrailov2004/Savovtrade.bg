<?php
session_start();
$conn = mysqli_connect("localhost:3305", "root", "", "savovdata");
if(isset($_POST['add_product'])){
   $product_category = $_POST['product_category'];
   $product_name = $_POST['product_name'];
   $product_manufacturer = $_POST['product_manufacturer'];
   $product_price = $_POST['product_price'];
   $product_description = $_POST['product_description'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'images/'.$product_image;
   $duplicate = mysqli_query($conn, "SELECT * FROM products WHERE name = '$product_name' AND category = '$product_category' AND image = '$product_image' AND price = '$product_price'");
   if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_category)){
      echo"<script> alert('Моля попълнете всичко нужно'); </script>";
   }else{
      if(mysqli_num_rows($duplicate) > 0){
         echo"<script> alert('Продукта е идентичен'); </script>";
      }
      else{
         $insert = "INSERT INTO products(category,name,manufacturer, price,description, image) VALUES('$product_category','$product_name','$product_manufacturer','$product_price', '$product_description', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         echo
      "<script> alert('Успешно добавяне на продукта'); </script>";
      }else{
        echo
        "<script> alert('Не може да се добави продукта'); </script>";
      }
      }
   }
};
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header('location:change.php');
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
      <?php
   $select = mysqli_query($conn, "SELECT * FROM products");
   ?>
    <div class="product-display">
      <table class="product-display-table">
         <tr>
            <th>Снимка</th>
            <th>Номер</th>
            <th>Категория</th>
            <th>Име на продукта</th>
            <th>Производител</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Промени или Изтрий</th>
         </tr>
        <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['Id']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['manufacturer']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo number_format($row['price'],2); ?> лв</td>
            <td>
               <a href="update.php?edit=<?php echo $row['Id'];?>"> <i class="fas fa-edit"></i> Промени </a><br>
               <a href="change.php?delete=<?php echo $row['Id'];?>"> <i class="fas fa-trash"></i> Изтрий </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>
    </aside>
</body>
</html>