<?php

namespace dateninjson\AbstractClass\Library;

use dateninjson\Interfaces\Library\IRequestHandler;

abstract class ARequestHandler implements IRequestHandler
{
    /**
     * @return array
     * $pattern = '/^\/([^\/]+)(\/([^\/]+))?/i'
     */
    abstract protected function cutUriParts():array;

    /**
     * @param $matches
     * @return void
     */
    abstract public function checkIfUriPartsExists($matches):void;
}