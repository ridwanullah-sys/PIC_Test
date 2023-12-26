<?php 
    require '../dbconn.php';
    
    function storeProductReview($reviewDetails){
        global $conn;

        $product_id = mysqli_real_escape_string($conn, $reviewDetails["product_id"]);
        $user_id = mysqli_real_escape_string($conn, $reviewDetails["user_id"]);
        $review_text = mysqli_real_escape_string($conn, $reviewDetails["review_text"]);

        //Validate required inputs
        if(empty(trim($product_id))){
            return fieldRequiredError('product_id');
        }else  if(empty(trim($user_id))){
            return fieldRequiredError('user_id');
        }else  if(empty(trim($review_text))){
            return fieldRequiredError('review_text');
        }//Validate Input Type
        else if(!is_numeric(trim($product_id))){
            return invalidInputTypeError('product_id should be a Number');
        }else  if(!is_numeric(trim($user_id))){
            return invalidInputTypeError('user_id should be a Number');
        }else  if(is_numeric(trim($review_text))){
            return invalidInputTypeError('review_text should be a String');
        } else {
            $query = "INSERT INTO product_review (product_id, user_id, review_text) VALUES ('$product_id', '$user_id', '$review_text')";
            
            $query_run = mysqli_query($conn, $query);
            if($query_run){
                $data = [
                    'status' => 201,
                    'message'=> $query_run,
                    'res' => $reviewDetails,
                ];
                header("HTTP/1.0 201 created");
                return json_encode($data);
            }else{
                $data = [
                    'status' => 500,
                    'message' => "Internal Server Error",
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);
            }
        };
    }

    function fieldRequiredError($field){
        $data = [
            'status' => 422,
            'message' => $field. " Field is Required",
        ];
        header("HTTP/1.0 422 Required Field Empty");
        echo json_encode($data);
        exit();
    }

    function invalidInputTypeError($message){
        $data = [
            'status' => 400,
            'message' => $message,
        ];
        header("HTTP/1.0 400 Bad Request");
        echo json_encode($data);
        exit();
    }

    function getProductReviews(){
        global $conn;
        $query = "SELECT * FROM product_review";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            if(mysqli_num_rows($query_run) > 0){
                $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

                $data = [
                    'status' => 200,
                    'message' => "Product Fetched Success",
                    'res'=> $res
                ];
                header("HTTP/1.0 200 Product Fetched Success");
                return json_encode($data);
            }else{
                $data = [
                    'status' => 404,
                    'message' => "No Product Found",
                ];
                header("HTTP/1.0 404 No Product Found");
                return json_encode($data);
            }

        }else{
            $data = [
                'status' => 500,
                'message' => "Internal Server Error",
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
?>