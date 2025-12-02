<?php

function recuperaTexto(string $parametro): false|string {
    return isset($_REQUEST[$parametro]) ? trim($_REQUEST[$parametro]) : false;
}
