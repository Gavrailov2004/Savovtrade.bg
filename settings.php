<?php
session_start();
$conn = mysqli_connect("localhost:3305", "root", "", "savovdata");
if(isset($_POST['add_product'])){
   $product_category = $_POST['product_category'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_folder = 'images/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_category)){
    echo"<script> alert('Моля попълнете всичко нужно'); </script>";
   }else{
      $insert = "INSERT INTO products(category,productName, price, image) VALUES('$product_category','$product_name','$product_price', '$product_image')";
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

};
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header('location:changeProducts.php');
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
    <title>ChangeProducts-admin-panel</title>
</head>
<body>
    <header>
        <div class="navigation">
            <i class="fa-solid fa-rectangle-xmark"></i>
            <ul>
            <span class="icon-logo"><img src="images/logoweb.png" alt=""></span><br><span class="title-logo">Gavrailov's Huntshop </span>
                <li><a href="http://localhost/Gavrailov's_Huntshop/admin.php"><span class="icon"><i class="fa-solid fa-house"></i></span><span class="title">Начално меню</span></a></li>
                <li><a href="settings.html"><span class="icon"><i class="fa-solid fa-toolbox"></i></span><span class="title">Промени продукти</span></a></li>
                <li><a href="http://localhost/Gavrailov's_Huntshop/login.php"><span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span><span class="title">Излез</span></a></li>
            </ul>
        </div>
    </header>
    <aside class="productPage">
<div class="admin-product-form-container">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Добави нов продукт</h3>
         <input type="text" placeholder="Въведи категорията на продукта" name="product_category" class="box">
         <input type="text" placeholder="Въведи името на продукта" name="product_name" class="box">
         <input type="number" placeholder="въведи цената на продукта" name="product_price" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="Добави продукт">
      </form>
      </div>
      <?php
   $select = mysqli_query($conn, "SELECT * FROM products");
   ?>
    <div class="product-display">
      <table class="product-display-table">
        <th>
        <tr>
            <th>Снимка</th>
            <th>Номер</th>
            <th>Категория</th>
            <th>Име на продукта</th>
            <th>Цена</th>
         </tr>
        </th>
        <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="images/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['productName']; ?></td>
            <td><?php echo $row['price']; ?>лв</td>
            <td>
               <a href="updateProducts.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> Промени </a>
               <a href="changeProducts.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> Изтрий </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>
    </aside>
</body>
</html>