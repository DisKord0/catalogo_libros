<?php
session_start();
// Aseguramos la ruta correcta al Modelo con mayúscula
require_once "../../Model/Libro.php";

// 1. Protección de acceso
if (!isset($_SESSION["USU_CUE"])) {
    header("location: ../../index.php");
    return;
}

try {
    // 2. Obtener la lista de libros del Modelo
    $libros = Libro::lista();

    // 3. Renderizar (Crear el HTML de las filas de la tabla)
    $render = "";
    
    // Generamos el encabezado de la tabla primero
    // Nota: La etiqueta <table> se abre en la Vista, aquí solo generamos el contenido interior.
    $render .= "<thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Año</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($libros as $libro) {
        $id = htmlentities($libro["LIB_ID"]);
        $titulo = htmlentities($libro["LIB_TITULO"]);
        $autor = htmlentities($libro["LIB_AUTOR"]);
        $anio = $libro["LIB_ANIO"] === null ? "(Desc.)" : htmlentities((string)$libro["LIB_ANIO"]);

        // Construimos la fila de la tabla
        $render .= "<tr>";
        $render .= "<td>" . $id . "</td>";
        $render .= "<td><strong>" . $titulo . "</strong></td>";
        $render .= "<td>" . $autor . "</td>";
        $render .= "<td>" . $anio . "</td>";
        $render .= "<td>
                        <!-- Botón para editar/eliminar -->
                        <a href='busca.php?id=$id' class='btn-accion btn-editar'>Modificar</a>
                    </td>";
        $render .= "</tr>";
    }
    
    $render .= "</tbody>";

    // 4. Mostrar la Vista (Ruta con mayúscula View)
    require "../../View/libros/lista.php";

} catch (Exception $error) {
    $errorHtml = htmlentities($error->getMessage());
    require "../../View/layout/error.php";
}
