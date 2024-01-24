<?php

include '../database.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $productId = intval($_POST['productId']);
    $quantity = floatval($_POST['quantity']);
    $totalPrice = intval($_POST['totalPrice']);
    $mobileNumber = $_POST['mobileNumber'];
}

//Begin Transaction
 $conn->begin_transaction();

 try{
    //INSERT INTO ORDERS TABLE
    $order_query = "INSERT INTO orders (total_price, customer_contact,) VALUES(?, ?)";
    $stmt = $conn->prepare($order_query);
    $stmt->bind_param('ds', $totalPrice, $mobileNumber);
    $stmt->execute();
    $order_id = $conn->insert_id;

    // Assuming price_per_unit is the price for each item not the total price
    $price_per_unit = $totalPrice / $quantity;

    $order_items_query = "INSERT INTO order_items(order_id, product_id, quantity, price) VALUES(?, ?, ?, ?)"
    $stmt = $conn->prepare($order_items_query);
    $stmt->bind_param("iidd", $order_id, $productId, $quantity, $price_per_unit);
    $stmt->execute()

    // Commit the transaction
    $conn->commit();

    //Instead of redirecting, send a json response
    header('Content-type: application/json');
    echo json_encode(array('success' => true, 'redirect' => 'KioskPHP/public/index.php?status=success'));

    //Insert into 

 }catch(Exception $e){

    // return an error message without redirecting
    header('Content-type: application/json');
    echo json_encode(array('success' => false, 'error' => $e->getMessage() ) );
    exit();
 } finally{
    //always close the connection
    $conn->close()
 }



















?>