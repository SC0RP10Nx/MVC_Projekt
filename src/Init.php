<?php

namespace dateninjson;


use dateninjson\Exceptions\Controller\NotFoundAction;
use dateninjson\Exceptions\Controller\NotFoundController;
use dateninjson\Exceptions\Textspeichernjson\ErrorInTextspeichern;
use dateninjson\Exceptions\Verzeichniserstellung\ErrorInVerzeichnis;
use dateninjson\Library\Controller\ControllerFactory;
use dateninjson\Library\Controller\RequestHandler;
use dateninjson\Library\Tools\AnzeigeTool;
use dateninjson\Views\Meldung\ViewMeldung;

class Init
{
    /**
     * @var RequestHandler $requestHandler
     */
    private RequestHandler $requestHandler;

    /**
     *
     */
    public function __construct()
    {
        $this->requestHandler = new RequestHandler($_SERVER);
    }

    public function setDisplay(): void
    {
        try {
            $controllerFactory = new ControllerFactory(__NAMESPACE__, $this->requestHandler);
            $controller = $controllerFactory->getController();
            $action = $this->requestHandler->actionName . 'Action';
            $controller->$action();
        } catch (NotFoundController|NotFoundAction $exceptionControllerAction) {
            ViewMeldung::getMeldung($exceptionControllerAction->getMessage());;
            #header("location: http://mvc-framework252.local/");
        } catch (ErrorInTextspeichern $errorInTextspeichern) {
            ViewMeldung::getMeldung($errorInTextspeichern->getMessage(),'/textspeichernjson');
        } catch (ErrorInVerzeichnis $errorInVerzeichnis) {
            ViewMeldung::getMeldung($errorInVerzeichnis->getMessage(),'/verzeichniserstellung');
        }
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->requestHandler->controllerName;
    }

}