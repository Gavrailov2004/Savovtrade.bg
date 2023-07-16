<?php
session_start();
$conn = mysqli_connect("localhost:3305", "root", "", "savovdata");
$id = $_GET['edit'];
if(isset($_POST['change'])){
   $product_category = $_POST['dropdownMenu'];
   $product_name = $_POST['product_name'];
   $product_manufacturer = $_POST['product_manufacturer'];
   $product_price = $_POST['product_price'];
   $product_description = $_POST['product_description'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'images/'.$product_image;
      $update = "UPDATE products SET category = '$product_category', name ='$product_name', manufacturer = '$product_manufacturer', price = '$product_price', description = '$product_description', image = '$product_image'
      WHERE id = $id";
      $upload = mysqli_query($conn,$update);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:change.php');
      }else{
        echo
        "<script> alert('Не може да се добави снимката!'); </script>";
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
<?php
      
      $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Промени продукта</h3>
      <input type="file" class="box" name="product_image" value="<?php echo $row['image'];?>"  accept="image/png, image/jpeg, image/jpg" >
      <select name="dropdownMenu" class="box">
         <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
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
      <input type="text" class="box" name="product_manufacturer" value="<?php echo $row['manufacturer']; ?>" placeholder="Въведи името на производителя">
      <input type="text" class="box" name="product_name" value="<?php echo $row['name']; ?>" placeholder="Въведи име">
      <input type="text" class="box" name="product_description" value="<?php echo $row['description']; ?>" placeholder="Въведи описание">
      <input type="text" min="0" class="box" name="product_price" value="<?php echo $row['price']; ?>" placeholder="Въведи цена">
      <input type="submit" value="Промени продукта" name="change" class="btn">
      <a href="admin.php" class="btn">Върни се!</a>
   </form>
   


   <?php }; ?>
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
            <th>Направи промоция</th>
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
               <a href="promo.php?edit=<?php echo $row['Id'];?>"> <i class="fas fa-trash"></i> Промоция </a>
            </td>
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