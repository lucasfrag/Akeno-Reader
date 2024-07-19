<?php
$read_status_file = './src/read_status.txt'; // Arquivo que armazena o estado de leitura

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = urldecode($_POST['file']);

    // Lê o estado de leitura atual
    $read_status = [];
    if (file_exists($read_status_file)) {
        $read_status = unserialize(file_get_contents($read_status_file));
    }

    // Alterna o estado de leitura
    if (isset($read_status[$file])) {
        $read_status[$file] = !$read_status[$file];
    } else {
        $read_status[$file] = true;
    }

    // Salva o novo estado de leitura
    file_put_contents($read_status_file, serialize($read_status));

    echo 'Status updated';
} else {
    echo 'Invalid request';
}
?>