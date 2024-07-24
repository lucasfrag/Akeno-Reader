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
            <h1 class="mb-0 ">Dashboard</h1>
          </div>

          <!-- Categorias -->
          <div class="card-body">
          <h2 class="">Library</h2>
            <div class="row">

            <?php 
              require_once('./assets/includes/file_search.php');
              require_once('./assets/includes/content.php');
              $dir = './files/';
              $folders = getPastas($dir);
              
              foreach ($folders as $folder) {
                  $conteudo = getConteudo($folder);

                  if(!is_null($conteudo)) {
                    echo "
                      <div class='col-sm-6 col-xl-3 col-lg-4'>
                        <a href='library.php?content=". $conteudo->nomePasta ."'>
                          <div class='card bg-dark border-white text-white card-image zoom-effect'>
                            <img class='card-img card-image' src='files/". $conteudo->nomePasta ."/cover.jpg'>
                            <div class='card-img-overlay'>
                              <h1 class='card-text text-white card-image-center'>".$conteudo->nomePasta."</h1>
                            </div>
                          </div>
                        </a>
                      </div>
                    ";

                  }
              }
            ?> 

          <!--    






            </div>-->
          </div>



          
          
          
          </div>
        </div>

        <?php
          include("assets/includes/footer.php")
        ?>



</body>

</html>