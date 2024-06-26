<?php

// Inicializar el carrito como un array vacío
$carrito = array();

// Función para agregar un producto al carrito
function agregar_al_carrito($producto, $precio, $cantidad) {
    global $carrito;
    $carrito[] = array(
        "producto" => $producto,
        "precio" => $precio,
        "cantidad" => $cantidad
    );
}

// Función para eliminar un producto del carrito por su nombre
function eliminar_por_nombre($nombre_producto) {
    global $carrito;
    foreach ($carrito as $indice => $item) {
        if ($item['producto'] === $nombre_producto) {
            unset($carrito[$indice]);
            $carrito = array_values($carrito); // Reindexar el array después de la eliminación
            echo "Producto '$nombre_producto' eliminado del carrito.\n";
            return; // Termina la función después de encontrar y eliminar el producto
        }
    }
    echo "El producto '$nombre_producto' no se encontró en el carrito.\n";
}

// Función para mostrar el contenido del carrito
function mostrar_carrito() {
    global $carrito;
    if (empty($carrito)) {
        echo "No hay productos en el carrito.\n";
    } else {
        echo "Productos agregados al carrito:\n";
        foreach ($carrito as $item) {
            echo "Producto: {$item['producto']}\n  Precio: {$item['precio']}\n Cantidad: {$item['cantidad']}\n";
        }
        echo "Total: " . calcular_total_carrito() . "\n";
    }
}

// Función para calcular el total del carrito
function calcular_total_carrito() {
    global $carrito;
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }
    return $total;
}

// Menú de opciones
do {
    echo "------ MENÚ ------\n";
    echo "1. Agregar producto al carrito\n";
    echo "2. Mostrar contenido del carrito\n";
    echo "3. Eliminar producto del carrito por nombre\n";
    echo "4. Salir\n";
    echo "Elija una opción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case '1':
            echo "Ingrese el nombre del producto:\n ";
            $producto = trim(fgets(STDIN));
            echo "Ingrese el precio del producto:\n ";
            $precio = trim(fgets(STDIN));
            echo "Ingrese la cantidad del producto:\n ";
            $cantidad = trim(fgets(STDIN));
            agregar_al_carrito($producto, $precio, $cantidad);
            echo "Producto agregado al carrito.\n";
            break;
        case '2':
            mostrar_carrito();
            break;
        case '3':
            echo "Ingrese el nombre del producto a eliminar: ";
            $nombre_producto = trim(fgets(STDIN));
            eliminar_por_nombre($nombre_producto);
            break;
        case '4':
            echo "Saliendo del programa. ¡Hasta luego!\n";
            exit;
        default:
            echo "Opción inválida. Por favor, seleccione una opción válida.\n";
            break;
    }
} while (true);
?>
