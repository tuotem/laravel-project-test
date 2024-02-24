<?php

if (! function_exists("splitStringToArrayWithSpace")) 
{
    function splitStringToArrayWithSpace(string $string) 
    {
        return explode(" ", $string);
    }
}