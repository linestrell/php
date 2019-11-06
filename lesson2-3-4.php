<?php
/*3.Реализовать основные 4 арифметические операции в виде функций с двумя параметрами. Обязательно использовать оператор return.*/
$a = 5;
$b = 15;
function addition($a, $b)
{
    return $a + $b;
}

echo addition($a, $b) . '<br>';

function subtraction($a, $b)
{
    return $a - $b;
}

echo subtraction($a, $b) . '<br>';

function multiplication($a, $b)
{
    return $a * $b;
}

echo multiplication($a, $b) . '<br>';

function division($a, $b)
{
    return $a / $b;
}

echo division($a, $b) . '<br>';

?>

<?php
/*4.Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов,
$operation – строка с названием операции. В зависимости от переданного значения операции выполнить одну из арифметических операций
(использовать функции из пункта 3) и вернуть полученное значение (использовать switch).*/
function mathOperation($arg1, $arg2, $operation)
{
    switch ($operation) {
        case '+':
            return addition($arg1, $arg2);
            break;
        case '-':
            return subtraction($arg1, $arg2);
            break;
        case '*':
            return multiplication($arg1, $arg2);
            break;
        case '/':
            return division($arg1, $arg2);
            break;
        default:
            return "return please";
    }
}

echo mathOperation(12, 3,'/');


?>

