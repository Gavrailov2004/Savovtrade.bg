<?php
session_start();
$conn = mysqli_connect("localhost:3305", "root", "", "savovdata");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Produkti</title>
</head>
<body>
    <section id="header">
        <nav class="nav1">
            <div class="Logo"><img src="img/logo.png" alt=""></div>
                <div class="name">
                    <h2>САВОВ ОЛ ТРЕЙД ЕООД</h2><p>Най-добрата борса за вас!</p>
                </div>
                <p><i class="fa fa-clock-o" aria-hidden="true"></i>
 Работно време: Понеделник - Петък от 8:00 до 17:00 <i class="fa fa-clock-o" aria-hidden="true"></i>
<br> <i class="fa fa-clock-o" aria-hidden="true"></i> Работно време: Събота - Неделя от 8:00 до 13:00 <i class="fa fa-clock-o" aria-hidden="true"></i>
 </p>
                <p><i class="fa fa-phone" aria-hidden="true"></i> Телефон за връзка: 0886227754 </p>
                <p><i class="fa fa-envelope-open" aria-hidden="true"></i>  Имейл за връзка: <a href="#">panelaabv.bg <br></a> <i class="fa fa-envelope-open" aria-hidden="true"></i> Имейл за връзка: <a href="#">nijikaabv.bg<br></a></p>
         
</nav>
        <div class="topnav" id="myTopnav">
            <a href="home.html" class="active"></i><i class="fa fa-home" aria-hidden="true"></i> Начало</a>
            <a href="kontacti.html" class="active"><i class="fa fa-phone" aria-hidden="true"></i> Контакти</a>
            <div class="dropdown">
            <a href="kontacti.html" class="dropbtn active"> Млечни продукти <i class="fa fa-caret-down"></i></a>
              <div class="dropdown-content drop1">
                <a href="#">Кашкавали</a>
                <a href="#">Сирена</a>
                <a href="#">Пресни млека</a>
                <a href="#">Кисели млека</a>
                <a href="#">Сметани</a>
                <a href="#">Масла и Маргарини</a>
                <a href="#">Майонези</a>
              </div>
            </div> 
            <div class="dropdown">
            <a href="kontacti.html" class="dropbtn active"> Консервени продукти <i class="fa fa-caret-down"></i></a>
                <div class="dropdown-content drop2">
                  <a href="#">Консерви с месо</a>
                  <a href="#">Консерви с риба</a>
                  <a href="#">Консерви със зеленчуци</a>
                  <a href="#">Лютеница, Горчица, Кетчуп</a>
                  <a href="#">Мариновани продукти</a>
                </div>
              </div> 
              <div class="dropdown">
              <a href="kontacti.html" class="dropbtn active"> Месни продукти  <i class="fa fa-caret-down"></i></a>
                <div class="dropdown-content drop3">
                  <a href="#">Луканкови салами и Суджуци</a>
                  <a href="#">Шпекови салами и Шунки</a>
                  <a href="#">Меки салами и Колбаси</a>
                  <a href="#">Кренвирши и Наденици</a>
                  <a href="#">Слайсове и Филета</a>
                  <a href="#">Скара и Сушени меса</a>
                  <a href="#">Пушени и Варени меса</a>
                  <a href="#">Паржоли ,Ребра и Саздърма</a>
                  <a href="#">Сланина и Кайма</a>
                  <a href="#">Морски дарове</a>
                </div>
              </div> 
              <div class="dropdown">
              <a href="kontacti.html" class="dropbtn active"> Други продукти  <i class="fa fa-caret-down"></i></a>
                <div class="dropdown-content drop4">
                  <a href="#">Бланширани храни</a>
                  <a href="#">Маслини</a>
                  <a href="#">Яйца</a>
                  <a href="#">Вина и Напидки</a>
                </div>
              </div>
              <div class="responsive">
                <i class="fa fa-solid fa-bars"></i>
                </div>
            </div>
     </section>
     <div class="search-container">
    <form action="search.php" method="POST">
      <input type="text" name="search" placeholder="Каво ще търсите?">
      <input type="submit" value="Търси">
    </form>
  </div>
    <div class="ProductSection">
    <section class="products">
    <h1 class="heading">Бланширани храни</h1>
    <div class="box-container">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category = 'Бланширани храни'");
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_product = mysqli_fetch_assoc($select_products)) {
        ?>
                <form action="" method="post">
                    <div class="box" style="border-color:<?php echo $fetch_product['color']; ?>">
                        <div class="Promotion">
                            <h3><?php echo $fetch_product['Promo']; ?></h3>
                        </div>
                        <img src="img/<?php echo $fetch_product['image']; ?>" alt="">
                        <a href="http://localhost/Savov_Ol_Trejd/BlanshiraniHrani.php">
                            <h4><?php echo $fetch_product['category']; ?></h4>
                        </a>
                        <h3 class="content"><?php echo $fetch_product['name']; ?></h3>
                        <p class="content"><?php echo $fetch_product['description']; ?></p>
                        <?php
                        $select_products1 = mysqli_query($conn, "SELECT * FROM `products` WHERE category = 'Бланширани храни' AND Promo = 'Промоция'");
                        $hasPromo = false;
                        while ($fetch_product_promo = mysqli_fetch_assoc($select_products1)) {
                            if ($fetch_product['Id'] === $fetch_product_promo['Id']) {
                                $hasPromo = true;
                                echo "<div class='price'>Стара цена: {$fetch_product_promo['price']} лв. </div>";
                                echo "<div class='nPrice'>Нова цена: {$fetch_product_promo['nPrice']} лв. {$fetch_product_promo['percent']}% </div>";
                                break;
                            }
                        }
                        if (!$hasPromo) {
                            echo "<div class='price'>Цена: {$fetch_product['price']} лв. </div>";
                        }
                        ?>
                        <input type="hidden" name="product_category" value="<?php echo $fetch_product['category']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="product_description" value="<?php echo $fetch_product['description']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                    </div>
                </form>
        <?php
            };
        };
        ?>
    </div>
</section>
    </div>
     <section class="section-one">
      <div class="container">
        <div class="col-div-6">
          <img src="img/logo.png" class="p-img-1">
        </div>
        <div class="col-div-6">
          <h2 class="h2w">Контакти<span> за</span> фирмата!</h2>
          <h2 class="h2w">Mожете да намерите пo-долу в страницата.</h2>
          <p class="para-1">  </p>
        </div>
        <div class="clearfix"></div>
      </div>
    </section>
    <section class="section-two">
      <div class="container">
        <div class="col-div-6">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1027.83119028009!2d27.89633627372524!3d43.227406498441496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40a4548bbc8e2371%3A0xb8ce409958ea5ef0!2z0YPQuy4g4oCe0KbQvtC90Y4g0KLQvtC00L7RgNC-0LLigJwgMywgOTAwOSDQodC10LLQtdGA0L3QsCDQv9GA0L7QvNC40YjQu9C10L3QsCDQt9C-0L3QsCwg0JLQsNGA0L3QsA!5e0!3m2!1sbg!2sbg!4v1686649925863!5m2!1sbg!2sbg" 
          width="550" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-div-6">
          <h2 class="h2w">Къде <span> се </span> намираме?</h2>
          <h2 class="h2w">Адрес: ул. „Цоню Тодоров“ 3 ,9009 Северна промишлена зона, Варна</h2>
        </div>
        <div class="clearfix"></div>
      </div>
    </section>
      <div class="footer">
        <div class="col-1">
        <h3>Контакти</h3>
        <p><i class="fa fa-envelope-open" aria-hidden="true"></i> Имейл за връзка: panelaabv.bg</a></p><br>
        <p><i class="fa fa-envelope-open" aria-hidden="true"></i> Имейл за връзка: nijikaoabv.bg</a></p><br>
        <p><i class="fa fa-phone" aria-hidden="true"></i> Телефон за връзка: 0886227754 </p>
       </div>
       <div class="col-4">
        <h3>Къде се намира?</h3>
        <p>Адрес: ул. „Цоню Тодоров“ 3 ,9009 Северна промишлена зона, Варна</p><br><br>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1027.83119028009!2d27.89633627372524!3d43.227406498441496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40a4548bbc8e2371%3A0xb8ce409958ea5ef0!2z0YPQuy4g4oCe0KbQvtC90Y4g0KLQvtC00L7RgNC-0LLigJwgMywgOTAwOSDQodC10LLQtdGA0L3QsCDQv9GA0L7QvNC40YjQu9C10L3QsCDQt9C-0L3QsCwg0JLQsNGA0L3QsA!5e0!3m2!1sbg!2sbg!4v1686649925863!5m2!1sbg!2sbg" 
        width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe><br><br><br>
        <p>Адрес: ул. „Цоню Тодоров“ 3 ,9009 Северна промишлена зона, Варна</p>
        <br>
        <p><i class="fa fa-phone" aria-hidden="true"></i> Телефон за връзка: 0886227754 </p>
       </div>
       
       <div class="col-3">
        <h3>Работно време</h3>
        <p><i class="fa fa-clock-o" aria-hidden="true"></i> Работно време: Понеделник - Петък от 8:00 до 17:00 <i class="fa fa-clock-o" aria-hidden="true"></i><br></p><br>
        <p><i class="fa fa-clock-o" aria-hidden="true"></i> Работно време: Събота - Неделя от 8:00 до 13:00 <i class="fa fa-clock-o" aria-hidden="true"></i></p>
       </div>
    
      </div>
</body>
</html>