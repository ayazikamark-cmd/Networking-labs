```php
<?php
session_start();

$products = [
    ["id"=>1,"name"=>"Laptop","usd"=>550,"ugx"=>2035000,"image"=>"assets/images/laptop.jpg"],
    ["id"=>2,"name"=>"Smart Phone","usd"=>300,"ugx"=>1110000,"image"=>"assets/images/smartphone.jpg"],
    ["id"=>3,"name"=>"Flash Disk 64GB","usd"=>12,"ugx"=>44400,"image"=>"assets/images/flashdisk.jpg"],
    ["id"=>4,"name"=>"Sofa Set","usd"=>450,"ugx"=>1665000,"image"=>"assets/images/sofa.jpg"],
    ["id"=>5,"name"=>"Smart TV","usd"=>400,"ugx"=>1480000,"image"=>"assets/images/tv.jpg"],
    ["id"=>6,"name"=>"Office Chair","usd"=>100,"ugx"=>370000,"image"=>"assets/images/chair.jpg"],
    ["id"=>7,"name"=>"Printer","usd"=>150,"ugx"=>555000,"image"=>"assets/images/printer.jpg"],
    ["id"=>8,"name"=>"WiFi Router","usd"=>50,"ugx"=>185000,"image"=>"assets/images/router.jpg"],
    ["id"=>9,"name"=>"Smart Watch","usd"=>80,"ugx"=>296000,"image"=>"assets/images/watch.jpg"],
    ["id"=>10,"name"=>"Headphones","usd"=>25,"ugx"=>92500,"image"=>"assets/images/headphones.jpg"]
];

if(isset($_POST['add_to_cart'])){
    $item = [
        "id" => $_POST['id'],
        "name" => $_POST['name'],
        "usd" => $_POST['usd'],
        "ugx" => $_POST['ugx']
    ];

    $_SESSION['cart'][] = $item;
    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Crocodile Teeth 🐊</title>

<style>

body{
font-family:Arial,sans-serif;
margin:0;
background:#f5f5f5;
}

header{
background:#0b7a20;
color:white;
padding:20px;
text-align:center;
}

.logo{
font-size:35px;
font-weight:bold;
}

.products{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
padding:20px;
}

.card{
background:white;
padding:15px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,.1);
text-align:center;
}

.card img{
width:100%;
height:220px;
object-fit:cover;
border-radius:10px;
}

button{
background:#0b7a20;
color:white;
padding:10px;
border:none;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#055012;
}

.topmenu{
padding:15px;
background:white;
text-align:center;
}

.topmenu a{
text-decoration:none;
margin:10px;
font-weight:bold;
color:#0b7a20;
}

footer{
background:#0b7a20;
color:white;
padding:15px;
text-align:center;
margin-top:30px;
}

</style>

</head>
<body>

<header>
<div class="logo">🐊 Crocodile Teeth</div>
<p>Your Trusted Online Shopping Store</p>
</header>

<div class="topmenu">
<a href="index.php">Home</a>
<a href="cart.php">Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a>
<a href="register.php">Register</a>
<a href="login.php">Login</a>
<a href="track-order.php">Track Order</a>
</div>

<div class="products">

<?php foreach($products as $product){ ?>

<div class="card">

<img src="<?php echo $product['image']; ?>">

<h3><?php echo $product['name']; ?></h3>

<p><strong>$<?php echo $product['usd']; ?></strong></p>

<p><strong>UGX <?php echo number_format($product['ugx']); ?></strong></p>

<form method="POST">

<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
<input type="hidden" name="name" value="<?php echo $product['name']; ?>">
<input type="hidden" name="usd" value="<?php echo $product['usd']; ?>">
<input type="hidden" name="ugx" value="<?php echo $product['ugx']; ?>">

<button type="submit" name="add_to_cart">
Add To Cart
</button>

</form>

</div>

<?php } ?>

</div>

<footer>
© 2026 Crocodile Teeth 🐊 | Buy & Sell Online
</footer>

</body>
</html>
```
