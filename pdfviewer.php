<?php
$read_status_file = './files/read_status.txt'; // Arquivo que armazena o estado de leitura
$content = $_GET['content'];

// Lê o estado de leitura dos arquivos
$read_status = [];
if (file_exists($read_status_file)) {
    $read_status = unserialize(file_get_contents($read_status_file));
}

// Verifica se o arquivo está marcado como lido
$isRead = isset($read_status[$content]) && $read_status[$content];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Reader</title>
</head>

<style>
body {
    margin: 0;
    background-color: #f5f5f5;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  
  #book-container {
    width: 100vw;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
  }
  
  #toolbar {
    text-align: center;
    margin-bottom: 10px;
    position: absolute;
    bottom: 0px;
    width: 55px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 15px;
    background-color: white;
  }
  
  canvas {
    border: none;
    margin: 0 auto;
    display: block;
    max-width: 100%;
    max-height: 100%;
  }
  
  .nav-btn, #fullscreen-btn, #exit-btn, #read-btn {
    background-color: white;
    color: black;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 24px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 0 10px;
  }

  .nav-btn:hover, #exit-btn:hover, #read-btn:hover {
    background-color: #f5f5f5;
  }
  
  #fullscreen-btn {
    position: absolute;
    bottom: 20px;
    right: 20px;
    background-color: #007bff;
    color: white;
  }

  #fullscreen-btn:hover {
    background-color: #0056b3;
  }
  
  #exit-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: white;
    color: black;
  }

  #read-btn {
    position: absolute;
    bottom: 70px;
    right: 20px;
  }
  
  #read-status-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    background-color: <?php echo $isRead ? '#d3d3d3' : '#ffffff'; ?>;
    color: black;
  }

</style>

<body>
  <div id="book-container">
    <div id="toolbar">
      <!--<button id="prev-page" class="nav-btn">◄</button>-->
      <span id="page-num"></span> / <span id="page-count"></span>
      <!--<button id="next-page" class="nav-btn">►</button>-->
    </div>
    <canvas id="pdf-render"></canvas>
    <button id="exit-btn" onclick="exitReader(event)">X</button>
    <button id="fullscreen-btn" onclick="toggleFullScreen(event)">⛶</button>
    <button id="read-btn" onclick="toggleRead(event, '<?php echo urlencode($content); ?>')" style="background-color: <?php echo $isRead ? '#23d93e' : '#ffffff'; ?>; color: <?php echo $isRead ? 'white' : 'black'; ?>">
        ✔
    </button>  
  </div>

  <script src="assets/js/pdf.js"></script>
  
  <script>
    document.addEventListener("DOMContentLoaded", function(event) {
      const url = <?php echo json_encode($content); ?>;

      let pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        canvas = document.getElementById('pdf-render'),
        ctx = canvas.getContext('2d');

      // Ajusta a escala para que o PDF caiba na tela inteira
      const fitPageToContainer = (page) => {
        const containerWidth = window.innerWidth;
        const containerHeight = window.innerHeight;
        const viewport = page.getViewport({
          scale: 1
        });
        const scale = Math.min(containerWidth / viewport.width, containerHeight / viewport.height);
        return scale;
      };

      // Renderiza a página
      const renderPage = num => {
        pageRendering = true;
        pdfDoc.getPage(num).then(page => {
          const scale = fitPageToContainer(page);
          const viewport = page.getViewport({
            scale: scale
          });
          canvas.height = viewport.height;
          canvas.width = viewport.width;

          const renderContext = {
            canvasContext: ctx,
            viewport: viewport
          };

          const renderTask = page.render(renderContext);

          renderTask.promise.then(() => {
            pageRendering = false;
            if (pageNumPending !== null) {
              renderPage(pageNumPending);
              pageNumPending = null;
            }
          });

          document.getElementById('page-num').textContent = num;
          document.getElementById('page-count').textContent = pdfDoc.numPages;
        });
      };

      const queueRenderPage = num => {
        if (pageRendering) {
          pageNumPending = num;
        } else {
          renderPage(num);
        }
      };

      const onPrevPage = () => {
        if (pageNum <= 1) {
          return;
        }
        pageNum--;
        queueRenderPage(pageNum);
      };

      const onNextPage = () => {
        if (pageNum >= pdfDoc.numPages) {
          return;
        }
        pageNum++;
        queueRenderPage(pageNum);
      };

      //document.getElementById('prev-page').addEventListener('click', onPrevPage);
      //document.getElementById('next-page').addEventListener('click', onNextPage);

      pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
        pdfDoc = pdfDoc_;
        document.getElementById('page-count').textContent = pdfDoc.numPages;
        renderPage(pageNum);
      });

      document.getElementById('book-container').addEventListener('click', function(e) {
        const containerWidth = this.clientWidth;
        if (e.clientX < containerWidth / 2) {
          onPrevPage();
        } else {
          onNextPage();
        }
      });

      // Event listeners para as setas do teclado
      document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
          onPrevPage();
        } else if (e.key === 'ArrowRight') {
          onNextPage();
        }
      });

    });

    // Função para alternar o modo de tela cheia
    function toggleFullScreen(event) {
        event.stopPropagation();
        if (!document.fullscreenElement) {
          document.documentElement.requestFullscreen();
        } else {
          if (document.exitFullscreen) {
            document.exitFullscreen();
          }
        }
    }

    // Função para sair do leitor
    function exitReader(event) {
        event.stopPropagation();
        history.back();
    }

    // Função para alternar o estado de leitura
    function toggleRead(event, file) {
        event.stopPropagation();
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
</body>

</html>
