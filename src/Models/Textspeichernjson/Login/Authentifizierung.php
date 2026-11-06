<?php

namespace dateninjson\Models\Textspeichernjson\Login;

use dateninjson\Exceptions\Textspeichernjson\ErrorInTextspeichern;



class Authentifizierung
{
    public static function ueberpruefungSession(): void
    {
        ob_start(); // Startet den Output Buffer
        if (headers_sent($file, $line)) {
            die("Fehler: Headers bereits gesendet in $file auf Zeile $line");
        }
        empty($_SESSION['login']) ? header('Location: /textspeichernjson/zumlogin') : header('Location: /textspeichernjson/toreadout');
        ob_end_flush(); // Gibt den Puffer aus und beendet ihn
        exit();
    }

    /**
     * @param string|null $username
     * @param string|null $passwd
     * @return void
     * @throws ErrorInTextspeichern
     */
    public static function ueberpruefeLogin(null|string $username = NULL, null|string $passwd = NULL): void
    {
        (isset($username) && isset($passwd)) ?: throw new ErrorInTextspeichern('keine User-Daten vorhanden!');
        //LoginDaten::userDatenIni() oder  LoginDaten::userDatenJson()
        //AnzeigeTool::printr(LoginDaten::userDatenIni()['login']);
        //echo array_search($passwd, LoginDaten::userDatenIni()['login']);
        ob_start(); // Startet den Output Buffer
        $foundPasswd = array_search($username, LoginDaten::userDatenJson());

        if ($foundPasswd !== false && $passwd === $foundPasswd) {
            $_SESSION['login'] = true;
            ///textspeichern/auslesen
            header('Location: /textspeichernjson/toreadout');
        } else {
            ///textspeichern/zumlogin/fehler
            header('Location: /textspeichernjson/zumlogin/fehler');
        }
        ob_end_flush(); // Gibt den Puffer aus und beendet ihn
        exit();
    }
}