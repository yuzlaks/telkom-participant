<?php 
$html = '<center><img src="data:image/svg+xml;base64,'.base64_encode($barcode).'"  width="200px" height="200px" /></center>';
?>
<style>
    *{
        font-family:'calibri'
    }
</style>
<center>
    <h1>Nama : {{ $nama }}</h1>
    <?= $html ?>
    <p>{{ $url }}<p>
</center>