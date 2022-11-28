<?php
include "localization/Eng_Dictionary.php";
include "localization/Rus_Dictionary.php";
class LANGUAGE
{
    public static $RU = "ru";
    public static $EN = "en";
}

class THEME
{
    public static $LIGHT = "light";
    public static $DARK = "dark";
}


$DICTIONARY = [
    "ru" => new RUS_DICTIONARY,
    "en" => new ENG_DICTIONARY,
];


$uploaddir = './files/';