<?php

namespace dateninjson\Interfaces\Library;

use dateninjson\Library\Controller\RequestHandler;

interface IControllerFactory
{
    /**
     * @param string $namespace
     * @param RequestHandler $requestHandler
     */
    public function __construct(string $namespace,RequestHandler $requestHandler);

    /**
     * @return object
     */
    public function getController():object;


}