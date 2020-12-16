<?php

class Connection{
    // main db connection
    public function main(){
        $servername = "localhost";
        $database = "detik";
        $username = "kausar";
        $password = "password";

        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }else{
            return $conn;
        }
    }
}
?>
