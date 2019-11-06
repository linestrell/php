<?php
// Получаем текущее время
$current_time = time();

// Получаем из него часы
$hours = date('H', $current_time);
// ... минуты
$minutes = date('i', $current_time);
// Получаем последнее число в часе (21 > 1)
$end_h = substr($hours, -1);
// Получаем последнее число в минутах
$end_m = substr($minutes, -1);

// Склонение в зависимости от последнего числа. Не забываем что на десятках есть исключение
if (($hours > 20 || $hours == 1) && $end_h == 1)
    $end_h_text = "час";
elseif (($hours < 10 || $hours > 20) && ($end_h >= 2 && $end_h <= 4))
    $end_h_text = "часа";
else
    $end_h_text = "часов";

// Аналогично для минут
$end_m_text = "минут";
if (($minutes > 20 || $minutes == 1) && $end_m == 1)
    $end_m_text = "минута";
elseif (($minutes < 10 || $minutes > 20) && ($end_m >= 2 && $end_m <= 4))
    $end_m_text = "минуты";
else
    $end_m_text = "минут";

echo "Сейчас: $hours $end_h_text $minutes $end_m_text";

