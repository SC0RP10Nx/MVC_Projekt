<?php

namespace dateninjson\Library;

use dateninjson\AbstractClass\Library\ARequestHandler;

class RequestHandler extends ARequestHandler
{
    /**
     * @param array $serverVariablen
     */
    public function __construct(private readonly array $serverVariablen)
    {
        $this->checkIfUriPartsExists($this->cutUriParts());
    }

    /**
     * @return array
     */
    protected function cutUriParts(): array
    {
        $pattern = '/^\/([^\/]+)(\/([^\/]+))?/i';
        preg_match($pattern, $this->serverVariablen['REQUEST_URI'], $matches);
        return $matches;
    }

    /**
     * @param $matches
     * @return void
     */
    protected function checkIfUriPartsExists($matches): void
    {
        /*  [0] => /anfahrt/senden
            [1] => anfahrt
            [2] => /senden
            [3] => senden*/
        $this->controllerName = $matches[1] ?? 'home';
        $this->actionName = $matches[3] ?? 'index';
    }

    /**
     * @var string
     */
    public string $controllerName {
        get {
            return $this->controllerName;
        }
    }
    /**
     * @var string
     */
    public string $actionName {
        get {
            return $this->actionName;
        }
    }
}