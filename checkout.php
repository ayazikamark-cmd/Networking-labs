```php
<?php
session_start();

if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){
    header("Location: cart.php");
    exit();
}

$totalUSD = 0;
$totalUGX = 0;

foreach($_SESSION['cart'] as $item){
    $totalUSD += $item['usd'];
    $totalUGX += $item['ugx'];
}

$orderPlaced = false;
$trackingCode = "";

if(isset($_POST['place_order'])){

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];

    $trackingCode = "CT-" . rand(10000,99999);

    $_SESSION['order'] = [
        "name" => $name,
        "phone" => $phone,
        "address" => $address,
        "payment" => $payment,
        "totalUSD" => $totalUSD,
        "totalUGX" => $totalUGX,
        "tracking" => $trackingCode,
        "status" => "Processing",
        "delivery" => date("Y-m-d", strtotime("+3 days"))
    ];

    $_SESSION['cart'] = []; // clear cart after order

    $orderPlaced = true;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout - Crocodile Teeth 🐊</title>

<style>
body{
    font-family:Arial;
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
    background:white;
    padding:20px;
    border-radius:10px;
}

input, select{
    width:100%;
    padding:10px;
    margin:10px 0;
}

button{
    background:#0b7a20;
    color:white;
    padding:12px;
    border:none;
    cursor:pointer;
    width:100%;
}

.summary{
    background:#eee;
    padding:10px;
    margin-bottom:20px;
}

.success{
    background:#d4edda;
    padding:15px;
    border-radius:5px;
}
</style>

</head>
<body>

<header>
<h1>🐊 Crocodile Teeth Checkout</h1>
</header>

<div class="container">

<?php if($orderPlaced){ ?>

<div class="success">
<h2>🎉 Order Placed Successfully!</h2>

<p><strong>Tracking Code:</strong> <?php echo $trackingCode; ?></p>
<p><strong>Status:</strong> Processing</p>
<p><strong>Estimated Delivery:</strong> 3 Days</p>

<p><strong>Total:</strong> 
$<?php echo $totalUSD; ?> / UGX <?php echo number_format($totalUGX); ?>
</p>

<br>

<a href="index.php">Continue Shopping</a>
</div>

<?php } else { ?>

<div class="summary">
<h3>Order Summary</h3>
<p>Total USD: $<?php echo $totalUSD; ?></p>
<p>Total UGX: UGX <?php echo number_format($totalUGX); ?></p>
</div>

<form method="POST">

<input type="text" name="name" placeholder="Full Name" required>
<input type="text" name="phone" placeholder="Phone Number" required>
<input type="text" name="address" placeholder="Delivery Address" required>

<select name="payment" required>
<option value="">Select Payment Method</option>
<option>MTN Mobile Money</option>
<option>Airtel Money</option>
<option>Visa Card</option>
<option>MasterCard</option>
</select>

<button type="submit" name="place_order">
Place Order
</button>

</form>

<?php } ?>

</div>

</body>
</html>
```
