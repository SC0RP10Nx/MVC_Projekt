<?php

namespace dateninjson\Interfaces\Controller;

interface IController
{
    /**
     * @return void
     *  Muss in jedem Controller vorhanden sein!
     */
    public function indexAction():void;
}