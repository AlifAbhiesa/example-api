# example-api

Init database
- Buat mysql database dengan nama detik
- konfigurasi host, username, dan password mysql pada file <b> Connection.php </b>
- Masuk ke folder projek dan ketikkan perintah <b>php Migrate.php</b> untuk migrasi database
- Jika ingin menambahkan data dummy ketikkan perintah <b>php SeedData.php</b>
<br>

<h1> POSTMAN </h1>

<h2> Membuat transaksi </h2>
Menggunakan postman, pastikan memberikkan parameter seperti yang sudah ditentukan
<img src="https://i.ibb.co/JnHFP1g/image.png" alt="image" border="0">

<h2> Mengambil data transaksi </h2>
<img src="https://i.ibb.co/N9Nt0mH/image.png" alt="image" border="0">

<h2> Mengupdate status pembayaran </h2>
<br>
Ketikkan perintah
<br>
<i> php TransactionUpdate.php </i>
<p> berikan masukkan Reference_id status (PAID/FAILED) </p>
<p> Contoh REF_123 PAID </p>
<p> Notes : Menggunakan spasi, input dipisahkan berdasarkan spasi

<h2> PHP CLI </h2>
<h2> Membuat Transaksi </h2>
<br>
ketikkan perintah
<br>
<i>php TransactionCreate.php</i>
<br>
<p> berikan masukkan invoice_id,item_name,amount,payment_type,customer_name,merchant_id </p>
<p> Contoh 120,Balon,1000,virtual_account,Alif,2 </p>
<p> Notes : Tidak menggunakan spasi, input dipisahkan berdasarkan koma
<br>
  

<h2> Mengupdate status pembayaran </h2>
<br>
Ketikkan perintah
<br>
<i> php TransactionUpdate.php </i>
<p> berikan masukkan Reference_id status (PAID/FAILED) </p>
<p> Contoh REF_123 PAID </p>
<p> Notes : Menggunakan spasi, input dipisahkan berdasarkan spasi
  

<h2> Mengambil data transaksi </h2>
<br>
Ketikkan perintah
<br>
<i> php TransactionGet.php </i>
<p> berikan masukkan Reference_id,merchant_id </p>
<p> Contoh REF_123,2 </p>
<p> Notes : Tidak menggunakan spasi, input dipisahkan berdasarkan koma
<br>
<p> Yang akan ditampilkan adalah data terakhir dari transaksi dan history perubahan status pembayaran data transaksi </p>
