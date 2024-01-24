<?php
include '../config/database.php';

$sql = "SELECT 
            o.order_id, 
            o.date_time as order_date, 
            o.customer_contact, 
            o.total_price as order_total_price,
            p.name as product_name, 
            p.price_per_unit, 
            p.unit, 
            p.image_url, 
            oi.quantity, 
            oi.price as item_price
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN products p ON oi.product_id = p.product_id";

$result = $conn->query($sql);
$orders_data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($orders_data, $row);
    }
} else {
    echo "0 results";
}
$conn->close();

// Include the header template
include '../template/header.php';
?>

<div class="container mt-4">
  <h1 class="mb-4">Orders List</h1>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Order Date</th>
        <th scope="col">Customer Contact</th>
        <th scope="col">Order Total Price</th>
        <th scope="col">Product Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Item Price</th>
        <th scope="col">Product Image</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders_data as $order): ?>
      <tr>
        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
        <td><?php echo htmlspecialchars($order['customer_contact']); ?></td>
        <td><?php echo htmlspecialchars($order['order_total_price']); ?></td>
        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
        <td><?php echo htmlspecialchars($order['quantity']); ?></td>
        <td><?php echo htmlspecialchars($order['unit']); ?></td>
        <td>
          <img
            src="<?php echo htmlspecialchars($order['image_url']); ?>"
            alt="Product Image"
            class="img-fluid"
            style="max-width: 100px"
          />
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php
// Include the footer template
include '../template/footer.php';
?>
