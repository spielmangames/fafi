<?php

require_once 'app/boot/bootstrap.php';


$size = [11 => 'S', 12 => 'L'];
$color = [21 => 'B', 22 => 'W'];
$material = [31 => 'C', 32 => 'P'];

$combinations22 = calculateCartesianProduct([1 => $size, 2 => $color]);
$combinations222 = calculateCartesianProduct([1 => $size, 2 => $color, 3 => $material]);

$zzz = 1;


function calculateCartesianProduct(array $options): array
{
    $combinations = [[]];
    foreach ($options as $optionId => $optionValues) {
        $append = [];
        foreach ($optionValues as $optionValueId => $optionValue) {
            foreach ($combinations as $data) {
                $append[] = $data + [$optionId => $optionValueId];
            }
        }
        $combinations = $append;
    }

    return $combinations;
}

