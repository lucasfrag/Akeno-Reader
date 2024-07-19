<?php

require_once('./assets/includes/file_search.php');

if ($_GET['content']) {
    $conteudo = $_GET['content'];

    if ($conteudo == "mangas") {
        $nomePasta = "Mangás";
        $pastaRaiz = './src/Mangás/'; 
    } else if ($conteudo == "cursos") {
        $nomePasta = "Cursos";
        $pastaRaiz = './src/Cursos/';
        
    } else if ($conteudo == "ebooks") {
        $nomePasta = "E-books";
        $pastaRaiz = './src/E-books/';
    } else {
        $pastaRaiz = "./src/";
    }	
}




?>