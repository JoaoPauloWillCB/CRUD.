<?php
namespace App\Classes;

class Alert
{

    public static function setError($error)
    {

        $_SESSION['error'] = $error;

    }

    public static function clearError()
    {

        $_SESSION['error'] = NULL;

    }

    public static function getError()
    {

        $error = isset($_SESSION['error'])?$_SESSION['error']:NULL;

        Alert::clearError();
        
        return $error;

    }

    public static function setSucess($sucess)
    {

        $_SESSION['sucess'] = $sucess;

    }

    public static function clearSucess()
    {

        $_SESSION['sucess'] = NULL;

    }

    public static function getSucess()
    {

        $sucess = isset($_SESSION['sucess'])?$_SESSION['sucess']:NULL;

        Alert::clearSucess();

        return $sucess;

    }

    public static function setWarning($warning)
    {

        $_SESSION['warning'] = $warning;

    }

    public static function clearWarning()
    {

        $_SESSION['warning'] = NULL;

    }

    public static function getWarning()
    {

        $warning = isset($_SESSION['warning'])?$_SESSION['warning']:NULL;

        Alert::clearWarning();

        return $warning;

    }

}