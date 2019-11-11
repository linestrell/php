<?php

function replaced($string){
    if(!is_string($string)) {
        return "incorrect argument {$string}";
    }
    return preg_replace('/\s/', '_', $string);
}

echo replaced('Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку.');


