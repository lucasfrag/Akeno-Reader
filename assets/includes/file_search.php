<?php

function calcularPastas($directoryPath)
{
    $items = scandir($directoryPath);

    // Inicializa a contagem de pastas
    $folderCount = 0;

    // Loop através dos itens
    foreach ($items as $item) {
        // Verifica se o item é uma pasta (diretório) e não é . ou ..
        if (is_dir($directoryPath . '/' . $item) && $item != "." && $item != "..") {
            $folderCount++;
        }
    }

    // Exibe o número de pastas encontradas
    return $folderCount;
}

function listarArquivosPDF($diretorio)
{
    $arquivos = array();

    $it = new RecursiveDirectoryIterator($diretorio);
    foreach (new RecursiveIteratorIterator($it) as $arquivo) {
        if (strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'pdf') {
            $arquivos[] = $arquivo->getPathname();
        }
    }

    return $arquivos;
}

function listarArquivosVideo($diretorio)
{
    $arquivos = array();

    $it = new RecursiveDirectoryIterator($diretorio);
    foreach (new RecursiveIteratorIterator($it) as $arquivo) {
        if (strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'mp4' || strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'mkv') {
            $arquivos[] = $arquivo->getPathname();
        }
    }

    return $arquivos;
}

function listarArquivosImagem($diretorio)
{
    $arquivos = array();

    $it = new RecursiveDirectoryIterator($diretorio);
    foreach (new RecursiveIteratorIterator($it) as $arquivo) {
        if (strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'jpg' || strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'jpeg' || strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'png' || strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'gif' || strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'webp') {
            $arquivos[] = $arquivo->getPathname();
        }
    }

    return $arquivos;
}

function organizarPorSubpasta($arquivosEncontrados) {
    foreach ($arquivosEncontrados as $arquivo) {
        $subpasta = basename(dirname($arquivo)); // Extrai o nome da subpasta
        if (!isset($itensPorSubpasta[$subpasta])) {
            $itensPorSubpasta[$subpasta] = [];
        }
        $itensPorSubpasta[$subpasta][] = $arquivo;
    }

    return $itensPorSubpasta;
}

function montarConteudoPDF($arquivoPorSubpasta) {
    $read_status_file = './files/read_status.txt'; // Arquivo que armazena o estado de leitura
    verificarSeReadExiste($read_status_file);

    // Lê o estado de leitura dos arquivos
    $read_status = [];
    if (file_exists($read_status_file)) {
        $read_status = unserialize(file_get_contents($read_status_file));
    }
        
    foreach ($arquivoPorSubpasta as $subpasta => $arquivos) {
        foreach ($arquivos as $index => $arquivo) {
            $filename = pathinfo($arquivo, PATHINFO_FILENAME);
            $isRead = isset($read_status[$arquivo]) && $read_status[$arquivo];
            echo "<div class='col'>
                <div class='card bg-white mb-3'>
                    <div class='card-body' style='width: 320px;'>
                        <div class='row'>
                            <div class='col'>
                                <h5 class='card-title text-uppercase text-muted mb-0'></h5>
                                <a class='text-default' href='pdfviewer.php?content=" . urlencode($arquivo) . "'>
                                    <span class='h3 mb-0 limitar-texto'>
                                        <i class='ni ni-single-copy-04' style='margin-right: 5px;'></i>" . htmlspecialchars($filename) . "
                                    </span>
                                </a>
                                <br>
                                <div style='display: inline-block;'>
                                    <button 
                                        onclick='toggleRead(\"" . urlencode($arquivo) . "\")'
                                        class='btn " . ($isRead ? 'btn-success' : 'btn-secondary') . "'>
                                        " . ($isRead ? '<i class="fa fa-check"></i> Read' : 'Not read') . "
                                    </button>
                                    <a href='pdfviewer.php?content=" . urlencode($arquivo) . "' class='btn btn-primary' type='button'>
                                        <i class='ni ni-bold-right'></i> Open
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
        }
    }
        
}

function calcularLidos ($diretorio) {
    $read_status_file = './files/read_status.txt'; // Arquivo que armazena o estado de leitura
    verificarSeReadExiste($read_status_file);

    // Lê o estado de leitura dos arquivos
    $read_status = [];
    if (file_exists($read_status_file)) {
        $read_status = unserialize(file_get_contents($read_status_file));
    }

    $todosArquivos = listarArquivosPDF($diretorio);
    //$arquivosVideo = listarArquivosVideo($diretorio);
    //$arquivosImagem = listarArquivosImagem($diretorio);
    //$todosArquivos = array_merge($arquivosPDF, $arquivosVideo, $arquivosImagem);

    $itensLidos = 0;

    foreach ($todosArquivos as $arquivo) {
        if (isset($read_status[$arquivo]) && $read_status[$arquivo]) {
            $itensLidos++;
        }
    }

    return $itensLidos;
}


function verificarSeReadExiste() {
    $filename = './files/read_status.txt';
    
    if (!file_exists($filename)) {
        $file = fopen($filename, 'w');
    }
}

function getPastas($dir) {
    $directories = [];

    if (is_dir($dir)) {
        // Abrir o diretório
        if ($dh = opendir($dir)) {
            // Ler o conteúdo do diretório
            while (($file = readdir($dh)) !== false) {
                // Verificar se é uma pasta, ignorando "." e ".."
                if ($file != "." && $file != ".." && is_dir($dir . DIRECTORY_SEPARATOR . $file)) {
                    $directories[] = $file;
                }
            }
            // Fechar o diretório
            closedir($dh);
        }
    }

    return $directories;
}