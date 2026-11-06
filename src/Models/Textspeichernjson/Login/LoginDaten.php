<?php
/**
 * Created by PhpStorm.
 * User: muellerd
 * Date: 13.02.2019
 * Time: 08:22
 */
declare(strict_types=1);

namespace dateninjson\Models\Textspeichernjson\Login;

use dateninjson\Exceptions\Textspeichernjson\ErrorInTextspeichern;
use dateninjson\Library\DirectoryHandling\DirectoryHandling;

class LoginDaten
{
    /**
     * @return array
     */
    public static function userDaten(): array
    {
        return array('mueller' => 'PINK', 'lorenz' => 'FLOYD');
    }

    /**
     * @return array
     * @throws ErrorInTextspeichern
     */
    public static function userDatenIni(): array
    {
        $path = LINUXROOT . 'src/Models/Textspeichernjson/Login/';
        $ini = 'LoginDaten.ini';
        $readIni = new DirectoryHandling($path, $ini);
        $readIni->getIsTrue() ?: throw new ErrorInTextspeichern('Logindaten oder File nicht vorhanden!');
        return parse_ini_file($readIni->getToTheFile(), true);
    }

    /**
     * @return array
     * @throws ErrorInTextspeichern
     */
    public static function userDatenJson(): array
    {
        $path = LINUXROOT . 'src/Models/Textspeichernjson/Login/';
        $json = 'LoginDaten.json';
        $readJson = new DirectoryHandling($path, $json);
        $readJson->getIsTrue() ?: throw new ErrorInTextspeichern('Logindaten oder File nicht vorhanden!');
        return json_decode(file_get_contents($readJson->getToTheFile()), true);
    }
}