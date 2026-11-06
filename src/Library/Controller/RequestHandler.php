<?php

namespace dateninjson\Library\Controller;

use dateninjson\AbstractClass\Library\ARequestHandler;

    /**
     * URI = Uniform Resource Identifier („einheitlicher Ressourcen-Finder“) → eine allgemeine Bezeichnung für einen „Bezeichner“ einer Ressource.
     * URL = Uniform Resource Locator („Einheitlicher Ressourcenbezeichner“) → eine spezielle Art von URI, die angibt, wo eine Ressource zu finden ist.
     * URI = „Was ist das für eine Ressource?“
     * URL = „Wo finde ich diese Ressource?“
     * URI = Bezeichner anfahrt/index
     * URL = Adresse  http://mvc-framework252.local/impressum
     * URI steht für Uniform Resource Identifier.
     * Das ist ein allgemeiner Begriff aus der Web-Technologie und bezeichnet eine Zeichenfolge,
     * die eine Ressource eindeutig identifiziert.
     */
class RequestHandler extends ARequestHandler
{
        /**
     * @param array $serverVariablen
     */
    public function __construct(private readonly array $serverVariablen)
    {
        /*echo PRE;
        print_r($serverVarablen);*/
        #echo $serverVarablen['REQUEST_URI'];
        $this->checkIfUriPartsExists($this->cutUriParts());
    }

    /**
     * @return array
     * Muster und Regeln
     * $pattern = '/^\/([^\/]+)(\/([^\/]+))?/i'
     */
    protected function cutUriParts(): array
    {
        $pattern = '/^\/([^\/]+)(\/([^\/]+))?/i';
        preg_match($pattern,$this->serverVariablen['REQUEST_URI'],$matches);
        return $matches;
    }

    /**
     * @param $matches
     * @return void
     */
    public function checkIfUriPartsExists($matches): void
    {
        $this->controllerName = $matches[1]??'Home';
        $this->actionName = $matches[3]??'index';
    }
    /**
     * @var string $controllerName
     */
    public string $controllerName = '' {
        get {
            return $this->controllerName;
        }
    }
    /**
     * @var string $actionName
     */
    public string $actionName = '' {
        get {
            return $this->actionName;
        }
    }
}