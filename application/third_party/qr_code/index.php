<?php

include "qrlib.php";

QRcode::png("Hidayat Saeful Rochman","KartuNama.png","H",4,4);

echo "<img src ='KartuNama.png' />";

?>