<?php

    
    include_once("Transaksi.php");
    // init class transaksi
    $tr = new Transaksi();
    echo "Transaksi: ";
    $data = fopen("php://stdin","r");

    // input dipisahkan koma
    $result = explode(",",trim(fgets($data)));

    try{
        if(count($result) < 5){
            throw new Exception('Input tidak lengkap!');
        }
        $tr->invoice_id = $result[0];
        $tr->item_name  = $result[1];
        $tr->amount = $result[2];
        $tr->payment_type = $result[3];
        $tr->customer_name = $result[4];
        $tr->merchant_id = $result[5];
        
        $tr->create();
    }catch(Exception $e){
        echo $e;
    }
    // contoh input
    // 120,Balon,1000,virtual_account,Alif,2
    

?>