<?php


function printNestedJson($data, $n = 0)
{
    // echo is_array($data);
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                printNestedJson($value, $n + 1);
            } else {
                $tab = str_repeat("+", $n);
                echo "<p>$tab {{ $key }} : {{ $value }}</p>";
            }
        }
    } else {
        echo "<p> false ...... $data</p>";
    }
}
