<?php

namespace Model;

class Counter
{
    public function getCounterFromFile($file_name)
    {
        if (file_exists($file_name)) {
            $lines = file($file_name);
            $counter = $lines[0];
            return $counter;
        } else {
            return -1;
        }
    }

    public function increaseCounter($file_name)
    {
        $counter = $this->getCounterFromFile($file_name);
        if ($counter != -1) {
            $this->storeCounterIntoFile($file_name, ++$counter);
            return true;
        } else {
            return false;
        }
    }

    public function storeCounterIntoFile($file_name, $counter = 0)
    {
        $returned_value = true;
        $file_pointer = fopen($file_name, "w");
        if ($file_pointer) {
            if(fwrite($file_pointer, $counter . PHP_EOL)) {
                fclose($file_pointer);
            } else {
                $returned_value = false;
            }
        } else {
            $returned_value = false;
        }
        return $returned_value;
    }


}
