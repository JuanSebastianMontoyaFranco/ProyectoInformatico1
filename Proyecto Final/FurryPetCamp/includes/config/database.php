<?php
    function conectarDB() : mysqli{
        $db = new mysqli("localhost", "root", "root", "furrypetcamp");

        if(!$db) {
            echo "NONAS";
            exit;
        }
        return $db;
    }

?>