<?php

namespace dateninjson\Library;

use dateninjson\AbstractClass\Library\AControllerFactory;
use dateninjson\Exceptions\Controller\NotFoundAction;
use dateninjson\Exceptions\Controller\NotFoundController;

class ControllerFactory extends AControllerFactory
{
    /**
     * @var string $controllerName
     */
    protected string $controllerName;
    /**
     * @var object $controllerObject
     */
    protected object $controllerObject;
    /**
     * @var string
     */
    protected string $controllerPath;

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
     * namespace\Controllers\Home\Controller
     */
    protected function buildControllerNameWithNamespace(): void
    {
        $this->controllerName = '\\' . $this->namespace . '\\Controllers\\' . ucfirst($this->requestHandler->controllerName) . '\\Controller';
    }

    /**
     * @return void
     * Instanzieren des Objectes
     */
    protected function loadController(): void
    {
        $this->controllerObject = new $this->controllerName($this->requestHandler,$this->namespace);
    }

    /**
     * @return object
     * Rückgabe Instanz vom Controller-Object
     */
    public function getController(): object
    {
        return $this->controllerObject;
    }

    /**
     * @return void
     */
    protected function buildControllerPath(): void
    {
       $this->controllerPath =  LINUXROOT.'src/Controllers/'.ucfirst($this->requestHandler->controllerName).'/Controller.php';
    }

    /**
     * @return void
     * @throws NotFoundController
     */
    protected function checkIfControllerExists(): void
    {
        if(!file_exists($this->controllerPath))
        {
            throw new NotFoundController($this->requestHandler->controllerName.' Controller not found!');
        }
    }

    /**
     * @return void
     * @throws NotFoundAction
     */
    protected function checkIfActionExists(): void
    {
        if (!method_exists($this->controllerObject, $this->requestHandler->actionName.'Action'))
        {
            throw new NotFoundAction($this->requestHandler->actionName.' Action not found!');
        }
    }
}