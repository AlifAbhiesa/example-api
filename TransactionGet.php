<?php

    
    include_once("Transaksi.php");
    // init class transaksi
    $tr = new Transaksi();
    echo "Search : ";
    $data = fopen("php://stdin","r");

    // input dipisahkan koma
    $result = explode(",",trim(fgets($data)));

    // contoh input
    // REF_123,2
    try{
        if(count($result) < 2){
            throw new Exception('Input tidak lengkap!');
        }
        $tr->reference_id = $result[0];
        $tr->merchant_id  = $result[1];
    
        $tr->get();
    }catch(Exception $e){
        echo $e;
    }
    

?>