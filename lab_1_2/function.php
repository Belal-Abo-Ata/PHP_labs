<?php

require_once('./vendor/autoload.php');

// return boolean => true if it writes into the file and false otherwise
function store_in_file($file, $name, $email)
{
    $retured_value = false;
    $file_pointer = fopen($file, "a+");
    if ($file_pointer) {
        $user_data = date("Y-m-d H:i:s") . WORD_DELEMITER . $_SERVER["HTTP_USER_AGENT"] . WORD_DELEMITER . $name . WORD_DELEMITER . $email . PHP_EOL;
        if(fwrite($file_pointer, $user_data)) {
            fclose($file_pointer);
            $retured_value = true;
        }
    }

    return $retured_value;
}

function display_from_file($file)
{
    $lines = file($file);

    foreach($lines as $line) {
        $words = explode(WORD_DELEMITER, $line);
        $i = 0;
        foreach($words as $word) {
            switch($i) {
                case 0:
                    echo_in_tag("Date: $word", "h3");
                    break;
                case 1:
                    echo_in_tag("Browser: $word", "h3");
                    break;
                case 2:
                    echo_in_tag("Name: $word", "h3");
                    break;
                case 3:
                    echo_in_tag("Email: $word", "h3");
                    break;
            }
            $i++;
        }
        echo "<hr>";
    }
}


function echo_in_tag($string, $tag, $second_tag = '')
{
    if ($second_tag == '') {
        echo "<$tag>$string</$tag>";
    } else {
        echo "<$second_tag><$tag>$string</$tag></$second_tag>";
    }
}
