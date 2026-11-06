<?php
namespace dateninjson\Views\Verzeichniserstellung\UploadFormular;

    class ViewUploadFormular
    {
        /**
         * @return void
         */
        static public function getContent():void
       {
           $_SESSION['smarty']->display(__DIR__ . '/index.tpl.html');
           ?>
           <script>
               let setDrop = <?php echo json_encode('verz'); ?>;
           </script>
           <?php
        }
    }

