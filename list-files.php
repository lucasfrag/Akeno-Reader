<?php
require_once('./assets/includes/file_search.php');

$folderName = $_GET['folderName'];
$subfolderName = $_GET['subfolderName'];

$arquivosPDF = organizarPorSubpasta(listarArquivosPDF($folderName . '/' . $subfolderName));

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
                        <a class="text-default" href="javascript:history.back()">
                            <img src="./assets/img/back.png" height="30px"> Voltar
                        </a>
                    </div>

                    <!-- Categorias -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <center>
                                    <img style="object-position: top; object-fit: cover;   height: 200px" src="<?php echo  $folderName . $subfolderName . '/cover.jpg'; ?>">
                                    <br><br>
                                    <h1 class="card-text text-default" style="font-size: 28px;"><?php echo $subfolderName; ?></h1>

                                </center>
                                <br>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-12">
                                
                                    <div class='card-body'>
                                        <div class="row">

                                            <div class="col">
                                                <div class="row">
                                                    <?php montarConteudoPDF($arquivosPDF); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>

                </div>

                <?php
                include("assets/includes/footer.php")
                ?>
</body>
</html>

<script>
function toggleRead(file) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'toggle_read.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            location.reload();
        }
    };
    xhr.send('file=' + encodeURIComponent(file));
}
</script>