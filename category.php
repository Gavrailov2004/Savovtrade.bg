<?php
session_start();
$conn = mysqli_connect("localhost:3305", "root", "", "savovdata");
if(isset($_POST['add_product'])){
   $product_category = $_POST['product_category'];
   $duplicate = mysqli_query($conn, "SELECT * FROM products WHERE name = '$product_category'");
   if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_category)){
      echo"<script> alert('Моля попълнете всичко нужно'); </script>";
   }else{
      if(mysqli_num_rows($duplicate) > 0){
         echo"<script> alert('Продукта е идентичен'); </script>";
      }
      else{
      $insert = "INSERT INTO products(category) VALUES('$product_category')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         echo
      "<script> alert('Успешно добави категория'); </script>";
      }else{
        echo
        "<script> alert('Не може да се добави категория'); </script>";
      }
      }
   }

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
        <div class="navigation">
            <ul>
                <li><a href="http://localhost/Savov_Ol_Trejd/admin.php"><span class="icon"><i class="fa-solid fa-house"></i></span><span class="title">Начално меню</span></a></li>
                <li><a href="http://localhost/Savov_Ol_Trejd/change.php"><span class="icon"><i class="fa-solid fa-toolbox"></i></span><span class="title">Промени продукти</span></a></li>
                <li><a href="http://localhost/Savov_Ol_Trejd/category.php"><span class="icon"><i class="fa-solid fa-toolbox"></i></span><span class="title">Добави категории</span></a></li>
                <li><a href="home.html"><span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span><span class="title">Излез</span></a></li>
             </ul>
        </div>
        <div class="Logo"><img src="img/logo.png" alt=""></div>
                <div class="name">
                    <h2>САВОВ ОЛ ТРЕЙД ЕООД</h2><p>Най-добрата борса за вас!</p>
                </div>
    </header>
    <aside class="productPage">
<div class="admin-product-form-container">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Добави новa категория</h3>
         <input type="text" placeholder="Въведи категорията на продукта" name="product_category" class="box">
         <input type="submit" class="btn" name="add_category" value="Добави категория">
      </form>
      </div>
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
         </tr>
        <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['Id']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['manufacturer']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['price']; ?>лв</td>
         </tr>
      <?php } ?>
      </table>
   </div>
    </aside>
    <script>
  function validateNumber(event) {
    var input = document.getElementById('pn');
    var value = parseFloat(input.value);

    if (isNaN(value)) {
      event.preventDefault(); // Prevent form submission
      alert('Въведи валидно число.');
    }
  }
</script>
</body>
</html>