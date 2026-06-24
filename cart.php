```php
<?php
session_start();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_GET['remove'])){
    $index = $_GET['remove'];

    if(isset($_SESSION['cart'][$index])){
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    header("Location: cart.php");
    exit();
}

$totalUSD = 0;
$totalUGX = 0;

foreach($_SESSION['cart'] as $item){
    $totalUSD += $item['usd'];
    $totalUGX += $item['ugx'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Shopping Cart - Crocodile Teeth 🐊</title>

<style>

body{
    font-family:Arial,sans-serif;
    background:#f4f4f4;
    margin:0;
}

header{
    background:#0b7a20;
    color:white;
    text-align:center;
    padding:20px;
}

.container{
    width:90%;
    margin:auto;
    margin-top:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

table th,
table td{
    border:1px solid #ddd;
    padding:12px;
    text-align:center;
}

th{
    background:#0b7a20;
    color:white;
}

.btn{
    padding:10px 15px;
    border:none;
    text-decoration:none;
    border-radius:5px;
    cursor:pointer;
}

.remove{
    background:red;
    color:white;
}

.checkout{
    background:#0b7a20;
    color:white;
}

.home{
    background:#333;
    color:white;
}

.summary{
    background:white;
    padding:20px;
    margin-top:20px;
    border-radius:10px;
}

</style>

</head>
<body>

<header>
<h1>🐊 Crocodile Teeth Shopping Cart</h1>
</header>

<div class="container">

<?php if(count($_SESSION['cart']) > 0){ ?>

<table>

<tr>
<th>#</th>
<th>Product</th>
<th>Price USD</th>
<th>Price UGX</th>
<th>Action</th>
</tr>

<?php foreach($_SESSION['cart'] as $index=>$item){ ?>

<tr>
<td><?php echo $index+1; ?></td>

<td><?php echo $item['name']; ?></td>

<td>$<?php echo number_format($item['usd'],2); ?></td>

<td>UGX <?php echo number_format($item['ugx']); ?></td>

<td>
<a class="btn remove"
href="cart.php?remove=<?php echo $index; ?>">
Remove
</a>
</td>

</tr>

<?php } ?>

</table>

<div class="summary">

<h2>Order Summary</h2>

<p>
<strong>Total USD:</strong>
$<?php echo number_format($totalUSD,2); ?>
</p>

<p>
<strong>Total UGX:</strong>
UGX <?php echo number_format($totalUGX); ?>
</p>

<br>

<a href="index.php" class="btn home">
Continue Shopping
</a>

<a href="checkout.php" class="btn checkout">
Proceed To Checkout
</a>

</div>

<?php } else { ?>

<div class="summary">

<h2>Your Cart Is Empty</h2>

<p>Add products before proceeding to checkout.</p>

<br>

<a href="index.php" class="btn home">
Go Shopping
</a>

</div>

<?php } ?>

</div>

</body>
</html>
```
