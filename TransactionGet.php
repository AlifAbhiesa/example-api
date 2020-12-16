<?php

    
    include_once("Transaksi.php");
    // init class transaksi
    $tr = new Transaksi();
    echo "Search : ";
    $data = fopen("php://stdin","r");

    // input dipisahkan koma
    $result = explode(",",trim(fgets($data)));

    // contoh input
    // 120,Balon,1000,virtual_account,Alif,2
    $tr->reference_id = $result[0];
    $tr->merchant_id  = $result[1];

    $tr->get();

?>