<?php

    if (isset($_GET['content'])) {
        $content = getConteudo($_GET['content']);

        $nomePasta= $content->nomePasta;
        $pastaRaiz = $content->pastaRaiz;
    }

    function getConteudo($pasta) {
        // Inicializa um objeto vazio
        $conteudoObj = new stdClass();
        $conteudoObj->nomePasta = $pasta;
        $conteudoObj->pastaRaiz = './files/'.$pasta;

        switch ($pasta) {
            case "Mangás":
                $conteudoObj->pastaRaiz = './files/Mangás/';
                $conteudoObj->iconeNav = 'fa fa-star text-yellow';
                break;
            case "Cursos":
                $conteudoObj->pastaRaiz = './files/Cursos/';
                $conteudoObj->iconeNav = 'ni ni-book-bookmark text-primary';
                break;
            case "E-books":
                $conteudoObj->pastaRaiz = './files/E-books/';
                $conteudoObj->iconeNav = 'ni ni-books text-danger';
                break;          
            case "Sample":
                $conteudoObj->pastaRaiz = './files/Sample/';
                $conteudoObj->iconeNav = 'ni ni-books text-danger';
                break;                       
            default:
                $conteudoObj = NULL;
                break;
        }
    
        return $conteudoObj;
    }

?>