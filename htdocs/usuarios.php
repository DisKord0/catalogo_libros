<?php
require_once "bd/Bd.php";

try {
    $bd = Bd::pdo();
    // Consultamos usuarios
    $stmt = $bd->prepare("SELECT id, nombre, correo FROM usuarios ORDER BY nombre");
    $stmt->execute();
    $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $render = "";
    foreach ($lista as $modelo) {
        // Codificamos datos para URL y HTML
        $encodeId = urlencode($modelo["id"]);
        $id = htmlentities($encodeId);
        $nombre = htmlentities($modelo["nombre"]);
        $correo = htmlentities($modelo["correo"]);

       
        $render .= "
        <li>
            <p>
                <a href='usuarios-busca.php?id=$id'>$nombre ($correo)</a>
            </p>
        </li>";
    }

    require "usuarios-lista.php";

} catch (Exception $error) {
    $errorHtml = htmlentities($error->getMessage());
    require "error.php";
}