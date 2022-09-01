<?php 
namespace App;

require_once __DIR__."/src/Program.php";

$opcion = $_POST["form"];
$conditionBoton = false;
$condition = false;

$tipoDeProceso = "Elija una opcion a procesar";
$tituloDeTabla = "Aqui se mostrara los resultados";
if(!empty($opcion)) {
  $conditionBoton = true;
  switch($opcion) {
    case "op1":
        $tipoDeProceso = "Proceso para obtener estudiantes nuevos";
        $text1 = "Tutoria existente";
        $text2 = "Estudiantes matriculados";
        break;
    case "op2":
        $tipoDeProceso = "Proceso para obtener estudiante retirados";
        $text1 = "Tutoria existente";
        $text2 = "Estudiantes matriculados";
        break;
    case "op3":
        $tipoDeProceso = "Proceso para obtener tutoria balanceada";
        $text1 = "Tutoria existente";
        $text2 = "Estudiantes matriculados";
        break;
    case "op4":
        $tipoDeProceso = "Proceso para obtener tutoria distribuida";
        $text1 = "Docentes";
        $text2 = "Estudiantes matriculados";
        break;
  }
}

if (!empty($_FILES)) {
    $condition = true;
    $conditionBoton = false;
    $tipoDeProceso = "Elija una opcion a procesar";
    $filename1 = $_FILES["first-file"]["name"];
    $filename2 = $_FILES["second-file"]["name"];
    $bol = move_uploaded_file($_FILES["first-file"]["tmp_name"], "files/$filename1");
    $bol = move_uploaded_file($_FILES["second-file"]["tmp_name"], "files/$filename2");
    //var_dump($bol);
    $proceso = new Program();
    
    switch($opcion) {
      case "op1":
          $tituloDeTabla = "Relacion de estudiantes Nuevos";
          $arrayPrint = $proceso->resultNewStudents($filename1, $filename2);
          break;
      case "op2":
        $tituloDeTabla = "Relacion de estudiantes Retirados";  
          $arrayPrint = $proceso->resultRetiredStudents($filename1, $filename2);
          break;
      case "op3":
          
        $tituloDeTabla = "Relacion de tutoria existente balanceada";   
          $arrayPrint = $proceso->resultBalancedTutorship($filename1, $filename2);
          break;
      case "op4":
        $tituloDeTabla = "Relacion de nueva tutoria distribuida";    

          $arrayPrint = $proceso->resultDistributionTutorship($filename1, $filename2);
          break;
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@500&display=swap" rel="stylesheet">
  <link rel="shorcut icon" href = "./img/logo_unsaac.png">
  <link rel="stylesheet" href="./css/style.css">
  <title>Tutoria | Unsaac</title>
</head>
<body>
  <header class="header-section">
    <div class="header-section-container">
      <div class="header-section-logo-container">
        <figure class="logo-figure-container">
          <img src="./img/cicle-logo.png" alt="Logo">
        </figure>
      </div>
      <div class="header-section-purpose">
        <h2 class="purpose-text">
          DISTRIBUCION DE TUTORIA
        </h2>
        <p class="course-text">
          Desarrollo de Software I
        </p>
      </div>
      <div class="header-section-my-brand">
      <figure class="logo-figure-container">
          <img src="./img/logo_unsaac.png" alt="Logo">
        </figure>
      </div>
    </div>
  </header>
  <main class="main-section-container">
    <section class="main-section-principal-container">
      <section class="main-section-description-content">
        <div class="main-section-title-container">
          <h1 class="main-section-title-white">
            Distribucion de Tutoria,
            <br>
            <span class="main-section-title-orange">
              más fáciles que nunca.
            </span>
          </h1>
        </div>
        <div class="main-section-function-page-description">
          <div class="main-section-function-page-container">
            <h3 class="main-section-function-text">
              Está aplicación permite generar una tabla y exportar un archivo csv de los siguientes casos:
              <br>
              <span class="subtitle-amortization-type">
                Alumnos Nuevos
              </span>
              <br>
              Son los estudiantes que no estan en la lista de tutorados y se matricularon este semestre
              <br>
              <span class="subtitle-amortization-type">
                Alumnos Retirados
              </span>
              <br>
              Son los estudiantes que no se encuentran matricualdos en el semestre actual
              <br>
              <span class="subtitle-amortization-type">
                Tutoria Balanceada
              </span>
              <br>
              Es la tutoria existente balanceada con los nuevos matriculados
              <br>
              <span class="subtitle-amortization-type">
                Tutoria Distribuida
              </span>
              <br>
              Es la tutoria balanceada que se genera a partir de una lista de tutores y lista de estudiantes
            </h3>
          </div>
        </div>
      </section>
      <section class="main-section-form-content">
        <div class="main-section-form-container">
          <h4 class="title-form">
            <?= $tipoDeProceso ?>
            <br>
            
          </h4>
          <form class="main-section-form" action="./" method="post" enctype="multipart/form-data">
            <p class="input-submit">
                <button class="form-input-options" type="submit" name="form" value="op1">Alumnos Nevos</button>
                <button class="form-input-options" type="submit" name="form" value="op2">Alumnos Retirados</button>
                <button class="form-input-options" type="submit" name="form" value="op3">Tutoria Balanceada</button>
                <button class="form-input-options" type="submit" name="form" value="op4">Tutoria Distribuida</button>
            </p>
          </form>
          <form class="main-section-form" action="./" method="post" enctype="multipart/form-data">
            <?php if($conditionBoton): ?>
                <p>
                    <div>
                        <label class="form-label" for="first-file"><?= $text1 ?></label>
                        <input type="file" class="form-select-text" name="first-file" id="first-file" require>
                    </div> 

                    <div>
                        <label class="form-label" for="second-file"><?= $text2 ?></label>
                        <input type="file" class="form-select-text" name="second-file" id="second-file" require>
                    </div> 
                    
                    <div>
                        <p class="input-submit">
                            <button class="form-input-submit" type="submit" name="form" value="<?= $opcion ?>">Procesar</button>

                        <input type="button" class="form-input-refresh" value="Limpiar" onClick="window.location.reload();"/>
                        </p>
                    </div>              
                </p>
            <?php endif; ?>
            
          </form>
        </div>
      </section>
    </section>
    <?php if($condition): ?>
    <section class="main-section-js-container">
      <div class="main-section-js-content java-print-container">
        <h3>
        <?= $tituloDeTabla ?>
        </h3>
        <p class="java-print-container">
                <div class="java-table-title">
                    <span class="content-item">Item</span>
                    <span class="content-codigo">Codigo</span>
                    <span class="content-description">Nombres y Apellidos</span>
                </div>
                <?php $contador = 1; ?>
                <?php $contadorDocente = 1; ?>
                <?php foreach ($arrayPrint as $value): ?>
                    <div class="java-table-content">
                        <?php if(strlen($value[0]) > 6 || strlen($value[0]) < 3): ?>
                          <span class="content-item"><b><?= $contadorDocente ?></b></span>
                          <span class="content-codigo"><b><?= $value[0] ?></b></span>
                          <span class="content-description"><b><?= $value[1] ?></b></span>
                          <?php $contador = 0; ?>
                          <?php $contadorDocente ++; ?>
                        <?php else: ?>
                          <span class="content-item"><?= $contador ?></span>
                          <span class="content-codigo"><?= $value[0] ?></span>
                          <span class="content-description"><?= $value[1] ?></span>
                        <?php endif; ?>
                    </div>
                    <?php $contador++; ?>
                <?php endforeach; ?>
              </p>
            </div>
          </section>
          <?php endif; ?>
  </main>
  <footer class="footer-section-container">
    <section>
      <div class="footer-section-agreement">
        <p class="footer-section-agreement-title">
          Una alianza entre
          <br>
          <span class="footer-section-title-enterprice">
            Grupo 3
          </span>
          <br>
          y la
          <br>
          <span class="footer-section-title-university">
            Universidad Nacional San Antonio Abad del Cusco
          </span>
        </p>
      </div>
      <div class="footer-section-image-agreement">
        <figure class="footer-section-enterprice-logo">
          <img src="./img/cicle-logo.png" alt="">
        </figure>
        <figure class="footer-section-university-logo">
          <img src="./img/logo_unsaac.png" alt="">
        </figure>
      </div>
      <div class="footer-section-coworkers"> 
        <h3 class="footer-section-who-are-we">
          Grupo de trabajo
        </h3>
        <ul class="footer-section-coworkers-names">
            <li>Pfoccori Quispe Alex Harvey</li>
            <li>Ramos Danny</li>
          <li>Justino</li>
          <li></li>
        </ul>
      </div>
      <div class="footer-section-rights">
        <p class="footer-section-text-right">
          2022 © Curso de Desarrollo de software I - Ingeniería Informática y de Sistemas   |  Políticas de privacidad | Cookies | Aviso legal | Aceesibilidad
        </p>
      </div>
    </section>
  </footer>
  <script src="./js/index.js">
  </script>
</body>
</html>