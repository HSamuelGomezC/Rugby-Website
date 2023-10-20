<?php
    function conecta() {
        $con = new mysqli ("localhost", "root", "", "rugby");
        return $con;
    }
?>