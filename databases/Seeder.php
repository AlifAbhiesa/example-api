<?php 
include_once("Connection.php");
include_once("./Transaksi.php");  

class Seeder{

    private $conn;
    function __construct() {
        $connection = new Connection();
        $this->conn = $connection->main();

    }

    public function Seed(){
        // data transaksi
        $data_transaksi = array(
            array(
                'id' => 1000,
                'invoice_id' => '1000',
                'item_name' => 'Pensil',
                'amount' => '1000',
                'payment_type' => 'credit_card',
                'payment_status' => 'PENDING',
                'customer_name' => 'Alif Abhiesa',
                'merchant_id' => 1,
                'reference_id' => 'REF_'.rand(1000,9999),
                'va_number' => NULL,
            ),
            array(
                'id' => 1000,
                'invoice_id' => '3000',
                'item_name' => 'Balon',
                'amount' => '1000',
                'payment_type' => 'virtual_account',
                'payment_status' => 'PENDING',
                'customer_name' => 'Al Kautsar',
                'merchant_id' => 1,
                'reference_id' => 'REF_'.rand(1000,9999),
                'va_number' => rand(5555555555,9999999999),
            ),
            array(
                'id' => 1000,
                'invoice_id' => '2000',
                'item_name' => 'Spidol',
                'amount' => '5000',
                'payment_type' => 'virtual_account',
                'payment_status' => 'PENDING',
                'customer_name' => 'Erick',
                'merchant_id' => 1,
                'reference_id' => 'REF_'.rand(1000,9999),
                'va_number' => rand(5555555555,9999999999),
            )
        );

        for($i = 0; $i < count($data_transaksi); $i++){
            $sql = "INSERT INTO t_orders (invoice_id, item_name, amount, payment_type,
            customer_name, merchant_id, reference_id, va_number, payment_status)
            VALUES ('".$data_transaksi[$i]['invoice_id']."','".$data_transaksi[$i]['item_name']."','".$data_transaksi[$i]['amount']."','".$data_transaksi[$i]['payment_type']."',
            '".$data_transaksi[$i]['customer_name']."','".$data_transaksi[$i]['merchant_id']."','".$data_transaksi[$i]['reference_id']."','".$data_transaksi[$i]['va_number']."','".$data_transaksi[$i]['payment_status']."')";

            //create dummy data
            if ($this->conn->query($sql) === TRUE) {
                $transaksi = new Transaksi();
                // create log after create order
                $transaksi->create_log($data_transaksi[$i]['reference_id'], $data_transaksi[$i]['payment_status']);
            }else{
                echo "Error: " . $sql . " " . $this->conn->error;
            }
        }
    }
}
?>