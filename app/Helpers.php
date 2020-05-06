<?php
function getPrice($priceDecimals)
{
    $price=floatval($priceDecimals) / 100;
    return number_format($price,2,',',' ').' MAD';

}