<?php
error_reporting(0);
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Control-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('function.php');

$request_method = $_SERVER["REQUEST_METHOD"];

if($request_method == "POST"){
    $inputData = json_decode(file_get_contents("php://input"), true);
    if(empty($inputData)){
       
        $storeProductReview = storeProductReview($_POST);
    }else{
        $storeProductReview = storeProductReview($inputData);
    }
    echo $storeProductReview;
}
else{
    $data = [
        'status' => 405,
        'message' => $request_method. " Method Not Allowed. Only POST",
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>