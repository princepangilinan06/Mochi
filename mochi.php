<?php

$products = [
    "Classic" => ["price" => 50, "stock" => 20],
    "Matcha" => ["price" => 60, "stock" => 15],
    "Strawberry" => ["price" => 60, "stock" => 0],
    "Mango" => ["price" => 55, "stock" => 5]
];

$unpopularFlavors = ["Avocado", "Taro", "Black Sesame", "Coconut", "Lychee", "Ube", "Durian"];

$day = 'Monday';


$taxRate = 12; 

function get_reorder_message(int $stock): string {
    if ($stock < 10) {  
        return "Yes";
    } else {
        return "No";
    }
}


function get_total_value(float $price, int $quantity): float {
    return $price * $quantity; 
}


function get_tax_due(float $price, int $quantity, int $taxRate = 0): float {
    return ($price * $quantity) * ($taxRate / 100); 
}


$offer = match ($day) {
    'Monday' => '20% off on any mochi',
    'Tuesday' => 'No sale today',
    'Wednesday' => '10% off on any mochi',
    'Thursday' => '5% off on any mochi',
    'Friday' => '15% off on any mochi',
    'Saturday', 'Sunday' => '25% off on any mochi',
};


$maxPerBox = 6;
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
    <h2>We actually give offers depending on what day it is!</h2>
    <h3>Today is <?= $day ?></h3>
    <h3>Which means the offer today is <?= $offer ?></h3>

    <div class="mochi-card">
      <img src="img/classic.jpg" alt="Classic Mochi">
      <p>Classic Mochi</p>
      <strong>Price: Php 50 each</strong>
    </div>

    <div class="mochi-card">
      <img src="img/matcha.jpg" alt="Matcha Mochi">
      <p>Matcha Mochi</p>
      <strong>Price: Php 60 each</strong>
    </div>

    <div class="mochi-card">
      <img src="img/strawberry.jpg" alt="Strawberry Mochi">
      <p>Strawberry Mochi</p>
      <strong>Price: Php 60 each</strong>
    </div>

    <div class="mochi-card">
      <img src="img/mango.jpg" alt="Mango Mochi">
      <p>Mango Mochi</p>
      <strong>Price: Php 55 each</strong>
    </div>
  </section>

  <section class="stock-section">
    <h2>Mochi Flavors and Stock Availability</h2>

   
    <table class="stock-table">
      <tr>
        <th>Mochi Flavor</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Reorder?</th>
        <th>Total Stock Value</th>
        <th>Tax Due (<?= $taxRate ?>%)</th>
      </tr>

      <?php foreach ($products as $product_name => $data) { ?>
        <?php 
          $price = $data["price"];
          $stock = $data["stock"];
          $reorderMessage = get_reorder_message($stock);
          $totalValue = get_total_value($price, $stock);
          $taxDue = get_tax_due($price, $stock, $taxRate);
        ?>
        <tr>
          <td><?= $product_name ?> Mochi</td>
          <td>Php <?= number_format($price, 2) ?></td>
          <td>
            <?php if ($stock <= 0) { ?>
              Out of Stock!
            <?php } else { ?>
              <?= $stock ?>
            <?php } ?>
          </td>
          <td><?= $reorderMessage ?></td>
          <td>Php <?= number_format($totalValue, 2) ?></td>
          <td>Php <?= number_format($taxDue, 2) ?></td>
        </tr>
      <?php } ?>
    </table>

    <h3>Prices per Box (6 Mochis per box):</h3>

    <table class="price-table">
      <tr>
        <th>Flavor</th>
        <?php for ($box = 1; $box <= $maxBoxes; $box++) { ?>
          <th><?= $box ?> Box<?= $box > 1 ? 'es' : '' ?></th>
        <?php } ?>
      </tr>

      <?php foreach ($products as $flavor => $data) { ?>
        <tr>
          <td><?= $flavor ?> Mochi</td>
          <?php for ($box = 1; $box <= $maxBoxes; $box++) { ?>
            <?php $totalPrice = $data["price"] * $maxPerBox * $box; ?>
            <td>Php <?= number_format($totalPrice, 2) ?></td>
          <?php } ?>
        </tr>
      <?php } ?>
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
