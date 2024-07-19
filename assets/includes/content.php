<?php

    if ($_GET['content']) {
        $conteudo = $_GET['content']; 

        if ($conteudo == "sample") {
            $nomePasta = "Sample";
            $pastaRaiz = './files/Sample/';
        } else if ($conteudo == "mangas") {
            $nomePasta = "Mangas";
            $pastaRaiz = './files/Mangás/'; 
        } else if ($conteudo == "cursos") {
            $nomePasta = "Cursos";
            $pastaRaiz = './files/Cursos/';
            
        } else if ($conteudo == "ebooks") {
            $nomePasta = "E-books";
            $pastaRaiz = './files/E-books/';
        } else {
            $pastaRaiz = "./files/";
        }	
    }


?>