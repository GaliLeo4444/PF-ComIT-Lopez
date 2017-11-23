<?php
        session_start();
        header("Content-Type: application/json; charset=UTF-8");
        $_SESSION["cant_p_p"] += 1;

        $_SESSION["pedido"] [$_SESSION["cant_p_p"]]["id"] = $_GET["id"];
        $_SESSION["pedido"] [$_SESSION["cant_p_p"]]["cod"] = $_GET["cod"];
        $_SESSION["pedido"] [$_SESSION["cant_p_p"]]["cant"] = $_GET["cant"];

        echo json_encode("OK");
?>