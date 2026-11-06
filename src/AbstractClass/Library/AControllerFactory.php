<?php

namespace dateninjson\AbstractClass\Library;

use dateninjson\Interfaces\Library\IControllerFactory;

abstract class AControllerFactory implements IControllerFactory
{
    /**
     * @return void
     */
    abstract protected function buildControllerNameWithNamespace(): void;

    /**
     * @return void
     */
    abstract protected function loadController(): void;

    /**
     * @return void
     * Path zum jeweiligen Controoller prüfen
     */
    abstract protected function buildControllerPath(): void;

    /**
     * @return void
     * exists Controller Class
     */
    abstract protected function checkIfControllerExists(): void;

    /**
     * @return void
     * exists Action Methode
     */
    abstract protected function checkIfActionExists():void;
}