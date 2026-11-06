<?php

namespace dateninjson\Controllers\Spiel;

use dateninjson\AbstractClass\Controller\AController;
use dateninjson\Library\DirectoryHandling\DirectoryHandling;
use dateninjson\Library\Tools\AnzeigeTool;
use dateninjson\Models\Textspeichernjson\AuslesenDatensatz;
use dateninjson\Models\Textspeichernjson\SpeichernDatensatz;

class Controller extends AController
{
    public function indexAction(): void
    {
        $test = new AuslesenDatensatz(PATHSPEICHERORT,DATENSATZJSONFILE);
        $test->setNextDatensatz();
        AnzeigeTool::printr($test->getDatensatz());
    }
}