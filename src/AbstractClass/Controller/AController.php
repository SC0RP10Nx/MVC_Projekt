<?php

namespace dateninjson\AbstractClass\Controller;

use dateninjson\Interfaces\Controller\IController;
use dateninjson\Library\Controller\RequestHandler;


abstract class AController implements IController
{
    /**
     * @return void
     */
    public function indexAction():void
    {
        $this->getView();
    }

    /**
     * @param RequestHandler $requestHandler
     * @param string $namespace
     */
    final public function __construct(protected RequestHandler $requestHandler,protected string $namespace)
    {
    }

    /**
     * @return void
     *
     */
    protected function getView():void
    {
        $controllerName = ucfirst($this->requestHandler->controllerName);
        //use dateninjson\Views\Home\ViewHome;
        $className = $this->namespace.'\\Views\\'.$controllerName.'\\View'.$controllerName;
        $getView = 'get'.$controllerName;
        $className::$getView();
    }
}