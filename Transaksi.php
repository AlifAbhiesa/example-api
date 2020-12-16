<?php
// db connection
include_once("Connection.php"); 
class Transaksi{
    
    public $invoice_id;
    public $item_name;
    public $amount;
    public $payment_type;
    public $customer_name;
    public $merchant_id;
    public $reference_id;
    public $va_number;
    public $status;
    private $conn;
    
    function __construct() {
        $connection = new Connection();
        $this->conn = $connection->main();
    }
    public function create(){
        // ref id with random number and ref prefix
        $reference_id = 'REF_'.rand(1000,9999);
        if($this->payment_type == 'virtual_account'){
            $number_va = rand(5555555555,9999999999);
        }else{
            $number_va = NULL;
        }
        
        $this->conn->begin_transaction();

        $sql = "INSERT INTO t_orders (invoice_id, item_name, amount, payment_type,
        customer_name, merchant_id, reference_id, va_number, payment_status)
        VALUES ('$this->invoice_id', '$this->item_name', '$this->amount', '$this->payment_type',
        '$this->customer_name', '$this->merchant_id', '$reference_id', '$number_va',
        'PENDING')";

        if ($this->conn->query($sql) === TRUE) {
            // show amount if transaction type is VA
            if($this->payment_type == 'virtual_account'){
                $data = array(
                    'references_id' => $reference_id,
                    'number_va' => $number_va,
                    'status' => 'PENDING',
                    'amount' => $this->amount
                );
            }else{
                $data = array(
                    'references_id' => $reference_id,
                    'number_va' => $number_va,
                    'status' => 'PENDING',
                );
            }
            $this->conn->commit();

            $this->create_log($reference_id, 'PENDING');
            echo json_encode($data);
            
        } else {
            echo "Error: " . $sql . " " . $this->conn->error;
        }

    }

    public function update(){
        $this->conn->begin_transaction();
        $sql = "UPDATE t_orders SET payment_status = '$this->status' WHERE reference_id = '$this->reference_id'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Payment status updated!\n";

            $this->create_log($this->reference_id, $this->status);
        } else {
            echo "Error: " . $sql . " " . $this->conn->error;
        }

        $this->conn->commit();
    }

    // get some transaction
    public function get(){
        
        $sql = "SELECT * FROM t_orders where reference_id = '$this->reference_id' AND merchant_id = '$this->merchant_id'";
        $result = $this->conn->query($sql);
        $transaction = [];

        if(!empty($result->num_rows > 0)){
            while($row = $result->fetch_assoc()) {
                array_push($transaction, $row);
            }

            $sql = "SELECT * FROM t_log_orders where reference_id = '$this->reference_id'";
            $hist = $this->conn->query($sql);
            $history = [];
            
            if ($hist->num_rows > 0) {
              // output data of each row
              while($row2 = $hist->fetch_assoc()) {
                array_push($history, $row2);
              }
            }

            $data = array(
                'transaction' => $transaction,
                'history' => $history
            );

            echo json_encode($data);

            
        }else{
            $data = array(
                'message' => 'Tidak ada transaksi '
            );

            echo json_encode($data);
        }
        
    }

    // always create log after create / update transaction
    public function create_log($reference_id, $status){
        $this->conn->begin_transaction();
        $sql = "INSERT INTO t_log_orders (reference_id, payment_status)
        VALUES ('$reference_id', '$status')";

        if ($this->conn->query($sql) === TRUE) {
            echo "Log created!\n";
            $this->conn->commit();
        } else {

            $data = array(
                'message' => 'error '.$this->conn->error
            );

            echo json_encode($data);
        }
        
    }
}
    
?>