<?php
$int = 1;

include __DIR__ . '/lib/Autoloader.php';

$quant = new Image_FleshSkinQuantifier(__DIR__ . '/bild2.jpg');

if($quant->isPorn())
    echo 'This image contains a lot of skin colors, thus might contain some adult content';
else
    echo 'This image does not contain many skin colors, thus is not likely to contain adult content';
?>