<?php

function vd(mixed ...$values):mixed
{

    for($i = 0; $i < count($values); $i++){

        var_dump($values[$i]);
    }

    die;
}