<?php


$request = $_SERVER['REQUEST_URI'];

include_once("Transaksi.php");
// init class transaksi
$tr = new Transaksi();

switch ($request) {
    case '/create' :
        try{
            

            if(!isset($_POST['invoice_id']) || !isset($_POST['item_name']) || !isset($_POST['amount']) ||
            !isset($_POST['payment_type']) || !isset($_POST['customer_name']) || !isset($_POST['merchant_id'])){
                throw new Exception('Input tidak lengkap!');
            }else{
                $tr->invoice_id = $_POST['invoice_id'];
                $tr->item_name  = $_POST['item_name'];
                $tr->amount = $_POST['amount'];
                $tr->payment_type = $_POST['payment_type'];
                $tr->customer_name = $_POST['customer_name'];
                $tr->merchant_id = $_POST['merchant_id'];
                $tr->create();
            }

        }catch(Exception $e){
            $data = array(
                'message' => $e->getMessage()
            );
            echo json_encode($data);
        }

        break;
    case '/get' :
        try{
            if(!isset($_POST['reference_id']) || !isset($_POST['merchant_id'])){
                throw new Exception('Input tidak lengkap!');
            }
            
            $tr->reference_id = $_POST['reference_id'];
            $tr->merchant_id  = $_POST['merchant_id'];
        
            $tr->get();
        }catch(Exception $e){
            $data = array(
                'message' => $e->getMessage()
            );
            echo json_encode($data);
        }
        break;
    default:
        http_response_code(404);
        // require __DIR__ . '/Transaksi.php';
        break;
}


?>