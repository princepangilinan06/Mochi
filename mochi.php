<?php
$ClassicStock = 20;
$MatchaStock = 15;
$StrawberryStock = 0;
$MangoStock = 5;

$prices = [
    "Classic" => 2.00,
    "Matcha" => 2.50,
    "Strawberry" => 2.75,
    "Mango" => 3.00
];

$unpopularFlavors= ["Avocado", "Taro", "Black Sesame", "Coconut", "Lychee", "Ube", "Durian"];

$day = 'Monday';


$offer = match ($day) {
    'Monday' => '20% off on any mochi',
    'Tuesday' => 'No sale today',
    'Wednesday' => '10% off on any mochi',
    'Thursday' => '5% off on any mochi',
    'Friday' => '15% off on any mochi',
    'Saturday', 'Sunday' => '25% off on any mochi',
  
};

if ($ClassicStock <= 0) {
    $stock= "Out of Stock!";
}else {
    $stock= $ClassicStock;
}

if ($MatchaStock <= 0) {
}else {
    $stock1= $MatchaStock;
}

if ($StrawberryStock <= 0) {
    $stock2= "Out of Stock!";
} else {
    $stock2= $StrawberryStock;
} 

if ($MangoStock <= 0) {
    $stock3= "Out of Stock!";
} else {
    $stock3= $MangoStock;
}



$maxperBox = 6;
$maxBoxes = 10;




?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/header.php'; ?>

<body>
  <header>
    <h1>Welcome to the Mochi Store</h1>
    <img src="img/mochiBanner.jpg" alt="Mochi Banner">
  </header>


 <main>
  <section class="mochi-gallery">
  <h2>We actually give offers depends on what day is today!</h2>
  <h3>Today is <?= $day ?> </h3>
  <h3>Which means the offer today is <?= $offer ?></h3>

    <div class="mochi-card">
      <img src="img/classic.jpg" alt="Classic Mochi">
      <p>Classic Mochi</p>
      <strong>Price: $2.00 each</strong>
    </div>

    <div class="mochi-card">
      <img src="img/matcha.jpg" alt="Matcha Mochi">
      <p>Matcha Mochi</p>
      <strong>Price: $2.50 each</strong>
    </div>

    <div class="mochi-card">
      <img src="img/strawberry.jpg" alt="Strawberry Mochi">
      <p>Strawberry Mochi</p>
      <strong>Price: $2.75 each</strong>
    </div>

    <div class="mochi-card">
      <img src="img/mango.jpg" alt="Mango Mochi">
      <p>Mango Mochi</p>
      <strong>Price: $3.00 each</strong>
    </div>
  </section>

  <section class="stock-section">
    <h2>Mochi Flavors and Stock Availability</h2>
     <table class="stock-table">
        <tr>
          <th>Mochi Flavor</th>
          <th>Description</th>
          <th>Stocks</th>
          <th>Price</th>
        </tr>
        <tr>
          <td>Classic Mochi</td>
          <td>Soft, chewy rice dough filled with sweet red bean paste.</td>
          <td><?= $stock; ?></td>
          <td>$<?= $prices["Classic"]; ?></td>
        </tr>
        <tr>
          <td>Matcha Mochi</td>
          <td>Green Tea flavored mochi with a subtle leafy taste and smooth matcha filling.</td>
          <td><?= $stock1; ?></td>
          <td>$<?= $prices["Matcha"]; ?></td>
        </tr>
        <tr>
          <td>Strawberry Mochi</td>
          <td>Light pink mochi with a sweet strawberry filling it is fruity, soft, and refreshing.</td>
          <td><?= $stock2; ?></td>
          <td>$<?= $prices["Strawberry"]; ?></td>
        </tr>
        <tr>
          <td>Mango Mochi</td>
          <td>Yellowish mochi stuffed with mango purée for a sweet, tangy bite.</td>
          <td><?= $stock3; ?></td>
          <td>$<?= $prices["Mango"]; ?></td>
        </tr>
    </table>

   


<h3>Prices per Box (6 Mochis per box):</h3>

<table class="price-table">
    <tr>
        <th>Flavor</th>
        <?php
        $box = 1;
        while ($box <= $maxBoxes) {
            echo "<th>$box Box" . ($box > 1 ? "es" : "") . "</th>";
            $box++;
        }
        ?>
    </tr>

    <?php
    $i = 0;
    $flavors = array_keys($prices);
    while ($i < count($prices)) {
        $flavor = $flavors[$i];
        $pricePerMochi = $prices[$flavor];
        echo "<tr>";
        echo "<td>$flavor Mochi</td>";

        $box = 1;
        while ($box <= $maxBoxes) {
            $totalPrice = $pricePerMochi * $maxperBox * $box;
            echo "<td>$" . number_format($totalPrice, 2) . "</td>";
            $box++;
        }

        echo "</tr>";
        $i++;
    }
    ?>
</table>



    <div class="unpopular-flavors">
      <h3>Unpopular Mochi Flavors (soon to offer):</h3>
      <ul>
        <?php foreach ($unpopularFlavors as $flavor) { ?>
          <li><?= $flavor ?></li>
        <?php } ?>
      </ul>
      </div>
  </section>
</main>






<?php include_once 'includes/footer.php'; ?>
</body>
</html>
