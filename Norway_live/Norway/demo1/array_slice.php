<?php 
$input = array
(
    '0' => 'A',
    '1' => 'B',
    '2' => 'C',
    '3' => 'D'
);

array_splice($input, 0, 1);
print_r($input);

?>