<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Control-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('function.php');

$request_method = $_SERVER["REQUEST_METHOD"];

if($request_method == "GET"){
    $productReviews = getProductReviews();
    echo $productReviews;

}
else{
    $data = [
        'status' => 405,
        'message' => $request_method. "Method Not Allowed. Only GET",
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>