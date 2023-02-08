<?php 
$html = '<center><img src="data:image/svg+xml;base64,'.base64_encode($barcode).'"  width="300px" height="300px" /></center>';
?>
<style>
    *{
        font-family:'calibri'
    }
</style>
<center>
    <center><img src="https://telkomregional5.id/Telkomsel-Orbit-Logo.png" width="200px" alt="orbit"></center>
    <!-- <br> -->
    <h1>Agen POS : {{ $nama }}</h1>
    <?= $html ?>
    <p>{{ $url }}<p>
</center>