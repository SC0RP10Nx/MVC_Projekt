<?php

namespace dateninjson\Library\Controller;

use dateninjson\AbstractClass\Library\AControllerFactory;
use dateninjson\Exceptions\Controller\NotFoundAction;
use dateninjson\Exceptions\Controller\NotFoundController;


class ControllerFactory extends AControllerFactory
{
    /**
     * @var string $controllerPathNamespace
     */
    protected string $controllerPathNamespace;
    /**
     * @var string $controllerpath
     */
    protected string $controllerpath;
    /**
     * @var object $controllerObject
     */
    protected object $controllerObject;

    /**
     * @param string $namespace
     * @param RequestHandler $requestHandler
     */
    public function __construct(private readonly string $namespace, private readonly RequestHandler $requestHandler)
    {
        $this->buildControllerNameWithNamespace();
        $this->buildControllerPath();
        $this->checkIfControllerExists();
        $this->loadController();
        $this->checkIfActionExists();
    }

    /**
     * @return void
     * Path zum jeweiligen Controoller prüfen
     */
    protected function buildControllerPath(): void
    {
        $this->controllerpath = LINUXROOT . 'src/Controllers/' . ucfirst($this->requestHandler->controllerName) . '/Controller.php';
    }

    /**
     * @return void
     * exists Controller Class
     */
    protected function checkIfControllerExists(): void
    {
        if (!file_exists($this->controllerpath)) {
            throw new NotFoundController($this->requestHandler->controllerName . ' Controller not found!');
        }
    }

    /**
     * @return void
     * exists Action Methode
     */
    protected function checkIfActionExists(): void
    {
        if (!method_exists($this->controllerObject, $this->requestHandler->actionName.'Action'))
        {
            throw new NotFoundAction($this->requestHandler->actionName.' Action not found!');
        }
    }

    /**
     * @return void
     */
    protected function buildControllerNameWithNamespace(): void
    {
        $this->controllerPathNamespace = '\\' . $this->namespace . '\\Controllers\\' . ucfirst($this->requestHandler->controllerName) . '\\Controller';
    }

    /**
     * @return void
     */
    protected function loadController(): void
    {
        $this->controllerObject = new $this->controllerPathNamespace($this->requestHandler, $this->namespace);
    }

    /**
     * @return object
     */
    public function getController(): object
    {
        return $this->controllerObject;
    }
}