<?php
$a = 5;
$b = '05';
var_dump($a == $b);         // Почему true? Потому что нет проверки на тип данных,соответсвенно 5 = 5
var_dump((int)'012345');     // Почему 12345? Потому что мы заставляем php преобразовать строку в число. и так как int-целое число => целое число не может начинаться с 0.
var_dump((float)123.0 === (int)123.0); // Почему false? Потому что php сравнимает типы данных => float не равен int.
var_dump((int)0 === (int)'hello, world'); // Почему true? Потому что int пытается преобразовать строку,не содержащую чисел. поэтому возвращается 0.
