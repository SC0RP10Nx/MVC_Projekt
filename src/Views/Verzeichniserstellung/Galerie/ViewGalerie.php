<?php

namespace dateninjson\Views\Verzeichniserstellung\Galerie;

class ViewGalerie
{
    /**
     * @return void
     */
    static public function getContent():void
    {
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl.html');

        ?>
        <script>
            let setUri = <?php echo json_encode($_SESSION['verzeichnis']); ?>;
        </script>
        <?php
    }
}

