<?php

require_once('./assets/includes/file_search.php');
require_once('./assets/includes/content.php');

$arquivosEncontrados = listarArquivosPDF($pastaRaiz);
$itensPorSubpasta = organizarPorSubpasta($arquivosEncontrados);

// Parâmetro GET para a página atual
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

?>

<!DOCTYPE html>
<html>
<?php
include("assets/includes/head.php");
?>

<body>
    <?php
    include("assets/includes/header.php")
    ?>

    <!-- Page content -->
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow ">
                    <div class="card-header bg-transparent">
                        <h1 class=""><?php echo $nomePasta; ?></h1>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <?php
                            foreach ($itensPorSubpasta as $subpasta => $itens) {
                            ?>
                                
                                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
                                    <a href="./list-files.php?folderName=<?php echo $pastaRaiz; ?>&subfolderName=<?php echo $subpasta ?>">
                                        <div class="card zoom-effect bg-white">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto"><img style="height: 150px; object-fit: cover; object-position: top;" src="<?php echo $pastaRaiz . '/' . $subpasta . '/cover.jpg'; ?>"></div>
                                                    
                                                    <div class="col">
                                                        <h2 class="text-primary"><?php echo $subpasta; ?></h2>  

                                                        <h2 class="text-default"><?php echo calcularLidos($pastaRaiz . "/" . $subpasta); ?> / <?php echo sizeof(listarArquivosPDF($pastaRaiz . "/" . $subpasta)); ?></h2>

                                                        <a href="./list-files.php?folderName=<?php echo $pastaRaiz; ?>&subfolderName=<?php echo $subpasta ?>" class="btn btn-default" type="button"><i class="ni ni-bold-right text-white"></i> ABRIR</a>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </a>
                                </div>



                            <?php
                                
                            }
                            ?>






 
											
                        
										
									








                        </div>
                    </div>
                </div>
                <?php
                include("assets/includes/footer.php")
                ?>
                
</body>

</html>

</html>