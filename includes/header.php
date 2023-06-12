<?php session_start(); 
require_once("controller/MateriaAlumnoController.php");
require_once("controller/MateriaCarreraController.php");
require_once("controller/AlumnoController.php");
$materiaAlumnoController = new MateriaAlumnoController();
$materiaCarreraController = new MateriaCarreraController();
$alumnoController = new AlumnoController();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>PHP CRUD MYSQL</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <script src="./app.js" defer></script>
  </head>
  <body>
    <nav>
      <div class="menu-div">
          <div><a href="request.php?left-menu-action=none">Materias MVC CRUD</a></div>
          
          <?php 
              if(isset($_SESSION["nombre-alumno"])  ) {?>
          <div>
           <?php 
              echo $_SESSION["nombre-alumno"];
            ?>
          </div>
              
          <div>
            Legajo:
          <?php echo $_SESSION["legajo-alumno"] ?>
          </div>

          <?php echo "<div><a href='request.php?cerrarSesion=true'
          >Cerrar Sesion </a></div>" ;
          }?>
      
        </div>
    </nav>
