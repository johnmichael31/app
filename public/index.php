<?php 
// Include the database configuration file from the config folder
include '../config/database.php';
// Prepare the SQL QUERY to fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$products = array();


//Check if there are any results
if($result->num_rows > 0){
    // Output of data of each row
    while($row = $result->fetch_assoc()){
        array_push($products, $row);
    }
}else{
    echo'0 result';
}

include '../includes/header.php';

?>

<div class="container mt-4">
    <div class="row">
        <?php foreach($products as $item): ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="card h-100 border border-danger rounded" >
                <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="image-fluid"  data-bs-toggle="modal" data-bs-target="#imageModal" onclick="imageinModal(this.src)">
                <div class="card-body bg-success ">
                    <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                    <p class="card-text mb-2">Unit: <?php echo htmlspecialchars($item['unit']); ?></p>
                    <p class="card-text">Price: <?php echo htmlspecialchars($item['price_per_unit']); ?></p>
                    <button class="btn btn-primary">Add Item</button>
                    <button class="btn btn-dark" style="color:white;" data-bs-toggle="modal" data-bs-target="#orderModal">Order Item</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>




<?php 
include './modals/image_modal.php';
include './modals/order_modal.php';
include '../includes/footer.php';
?>
