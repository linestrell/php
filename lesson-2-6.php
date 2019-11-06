<?php
/*6. *С помощью рекурсии организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень.*/
$val = rand(1, 50);
$pow = rand(1, 10);

function power($val, $pow)
{
    if ($val == 0)
        return 0;
    elseif ($pow == 0)
        return 1;
    elseif ($pow < 0)
        return power(1 / $val, -$pow);
    else
        return $val * power($val, $pow - 1);
}

echo power($val, $pow);


