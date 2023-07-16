<?php
session_start();
$conn = mysqli_connect("localhost:3305", "root", "", "savovdata");
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM login WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
}
else{
  header("Location: login.php");
}
$conn = mysqli_connect("localhost:3305", "root", "", "savovdata");
if(isset($_POST['add_product'])){
   $product_category = $_POST['dropdownMenu'];
   $product_name = $_POST['product_name'];
   $product_manufacturer = $_POST['product_manufacturer'];
   $product_price = $_POST['product_price'];
   $product_description = $_POST['product_description'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'img/'.$product_image;
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
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Добави нов продукт</h3>
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <select name="dropdownMenu" class="box">
         <option value="Кашкавали">Кашкавали</option>
         <option value="Сирена">Сирена</option>
         <option value="Пресни млека">Пресни млека</option>
         <option value="Кисели млека">Кисели млека</option>
         <option value="Сметани">Сметани</option>
         <option value="Масла и Маргарини">Масла и Маргарини</option>
         <option value="Майонези">Майонези</option>
         <option value="Консерви с месо">Консерви с месо</option>
         <option value="Консерви с риба">Консерви с риба</option>
         <option value="Консерви с зеленчуци">Консерви с зеленчуци</option>
         <option value="Лютеница, Горчица, Кетчуп">Лютеница, Горчица, Кетчуп</option>
         <option value="Мариновани продукти">Мариновани продукти</option>
         <option value="Луканкови салами и Суджуци">Луканкови салами и Суджуци</option>
         <option value="Шпекови салами и Шунки">Шпекови салами и Шунки</option>
         <option value="Меки салами и Колбаси">Меки салами и Колбаси</option>
         <option value="Кренвирши и Наденици">Кренвирши и Наденици</option>
         <option value="Слайсове и Филета">Слайсове и Филета</option>
         <option value="Скара и Сушени меса">Скара и Сушени меса</option>
         <option value="Пържоли, Ребра и Саздърма">Пържоли, Ребра и Саздърма</option>
         <option value="Сланина и Кайма">Сланина и Кайма</option>
         <option value="Морски дарове">Морски дарове</option>
         <option value="Бланширани храни">Бланширани храни</option>
         <option value="Маслини">Маслини</option>
         <option value="Яйца">Яйца</option>
         <option value="Вина и Напитки">Вина и Напитки</option>
         </select>
         <input type="text" placeholder="Въведи името на продукта" name="product_name" class="box">
         <input type="text" placeholder="Въведи производителя на продукта" name="product_manufacturer" class="box">
         <input type="text" placeholder="Въведи описание на продукта" name="product_description" class="box">
         <input type="text" placeholder="въведи цената в цифра" name="product_price" id="productprice" class="box" >
         <input type="submit" class="btn" name="add_product" value="Добави продукт" onclick="validateDecimal(event)">
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
            <td><?php echo number_format($row['price'],2); ?> лв</td>
         </tr>
      <?php } ?>
      </table>
   </div>
    </aside>
    <script>
  function validateDecimal(event) {
    var input = document.getElementById('productprice');
    var value = parseFloat(input.value);

    if (isNaN(value)) {
      event.preventDefault();
      alert('Въведи число без букви');
    }
  }
</script>
</body>
</html>