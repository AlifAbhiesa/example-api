<?php 
include_once("Connection.php"); 
class Migration{

    private $conn;
    function __construct() {
        $connection = new Connection();
        $this->conn = $connection->main();
    }

    public function migrate(){
        $sql = "CREATE TABLE t_orders (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            invoice_id VARCHAR(255) NOT NULL,
            item_name VARCHAR(255) NOT NULL,
            amount INT(11) NOT NULL,
            payment_type VARCHAR(255) NOT NULL,
            payment_status VARCHAR(255) NOT NULL,
            customer_name VARCHAR(255) NOT NULL,
            merchant_id INT(11) NOT NULL,
            reference_id VARCHAR(255) NOT NULL,
            va_number VARCHAR(255) NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            
            if ($this->conn->query($sql) === TRUE) {
              echo "Table t_orders migrated!\n";
            } else {
              echo "Error creating t_orders table: " . $this->conn->error."\n";
            }

            $sql = "CREATE TABLE t_log_orders (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                payment_status VARCHAR(255) NOT NULL,
                reference_id VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            
            if ($this->conn->query($sql) === TRUE) {
                echo "Table t_log_orders migrated!\n";
              } else {
                echo "Error creating t_orders table: " . $this->conn->error."\n";
            }
    }
}
?>