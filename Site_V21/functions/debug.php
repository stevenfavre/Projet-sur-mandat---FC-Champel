<?php

//Permet de faire apparaitre une fenetre d'erreur en cas de besoin
function debug($sObj = NULL)
{
    if (is_null($sObj)) {
        echo '|Object is NULL|' . '\n';
    } elseif (is_array($sObj) || is_object($sObj)) {
        var_dump($sObj);
    } else {
        echo '|' . $sObj . '|' . '\n';
    }
}
