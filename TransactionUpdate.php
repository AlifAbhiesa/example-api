<?php

    include_once("Transaksi.php");
    // init class transaksi
    $tr = new Transaksi();
    echo "Transaksi update: ";
    $data = fopen("php://stdin","r");

    // input dipisahkan spasi
    $result = explode(" ",trim(fgets($data)));

    try{
        if(count($result) < 2){
            throw new Exception('Input tidak lengkap!');
        }

        // contoh input
        // REF_1234 PAID/FAILED
        $tr->reference_id = $result[0];
        $tr->status  = $result[1];
        
        $tr->update();
    }catch(Exception $e){
        echo $e;
    }

    
?>