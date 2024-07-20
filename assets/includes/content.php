<?php

    if (isset($_GET['content'])) {
        $content = getConteudo($_GET['content']);

        $nomePasta= $content->nomePasta;
        $pastaRaiz = $content->pastaRaiz;
    }

    function getConteudo($pasta) {
        $conteudoObj = new stdClass();
        $conteudoObj->nomePasta = $pasta;
        $conteudoObj->pastaRaiz = './files/'. $pasta . "/";


        /* PERSONALIZE CONTENT */
        // Add cases to set specific properties for each folder
        
        switch ($pasta) {
            case "Cursos":
                $conteudoObj->iconeNav = 'ni ni-book-bookmark text-primary';
                break;
            case "E-books": 
                $conteudoObj->iconeNav = 'ni ni-books text-danger';
                break;   
            case "Mangás":
                $conteudoObj->iconeNav = 'fa fa-star text-yellow';
                break;
            case "HQs":
                $conteudoObj->iconeNav = 'fa fa-star text-yellow';
                break;                                       
            case "Sample":
                $conteudoObj->iconeNav = 'ni ni-books text-danger';
                break;                       
            default:
                $conteudoObj->iconeNav = 'fa fa-star text-yellow';
                break;
        }
    
        return $conteudoObj;
    }

?>