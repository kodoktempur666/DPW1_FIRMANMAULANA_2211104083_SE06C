<?php

function isPrime($num) {
    if ($num <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}



for ($i = 2; $i <= 97; $i++) {
    if (isPrime($i)) {
        echo $i." adalah bilangan prima". " ";
        echo "<br>";
    }
}
?>
