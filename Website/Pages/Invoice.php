<?php
require_once "../Classes/Classess.php";
$ref = Generate::Invoice_RefCode();
Generate::Invoice($ref);
?>