<?php require_once('includes/header.php');

//renderizados de views
if (!isset($_SESSION["legajo-alumno"])) {
?>
<div class="layout-login-container">
  <?php
  $materiaAlumnoController->viewIniciarSesionAlumno(true);
  $materiaAlumnoController->viewRegistrarAlumno(true);
  ?>
</div>  
<?php
} else {
  ?>
  <div class="layout-container">
    <div class="layout-left-menu"> 

      <div class="link-menu"><a href="request.php?left-menu-action=mostrar-agregar-materia">AgregarMateria</a></div>
  <?php 
        if(isset($_SESSION["left-menu-action"]) and $_SESSION["left-menu-action"]=="mostrar-agregar-materia"){
          $materiaAlumnoController->viewAgregarMateriaAlumno(true);
        } 
  ?>
      <div class="link-menu"><a href="request.php?left-menu-action=mostrar-eliminar-materia">Eliminar Materia</a></div>
  <?php 
        if(isset($_SESSION["left-menu-action"]) and $_SESSION["left-menu-action"]=="mostrar-eliminar-materia"){
          $materiaAlumnoController->viewEliminarMateriaAlumno(true);
        }
  ?>
      <div class="link-menu"><a href="request.php?left-menu-action=mostrar-filtro-materia">Filtros Materia</a></div>  
  <?php 
        if(isset($_SESSION["left-menu-action"]) and $_SESSION["left-menu-action"]=="mostrar-filtro-materia"){
          $materiaAlumnoController->viewFiltrosMateriaAlumno(true);
        }
  ?>
    <div class="link-menu"><a href="request.php?crud-action=Promedio">Promedios Materia</a></div>  
  <?php          
     if(isset($_SESSION["left-menu-action"]) and $_SESSION["left-menu-action"]=="mostrar-promedio-materia"){
        $materiaAlumnoController->viewPromediosMateriaAlumno(true);
     }
  ?></div>
    
    <div class="layout-main-content"><?php $materiaAlumnoController->viewMostrarMateriaAlumno();?></div>
    <!--<div class="layout-right-menu"></div>-->
  </div>
  
<?php }

//Solicitud para iniciar sesion

//<input type="button" onclick="location='view/insertMateria.php'" />
//<a href=<?php echo constant('BASE_URL')."/index.php?controller=materia&action=listar&listado=".$mostrarListar   ¿>>Listar</a>
?>

<?php require_once('includes/footer.php');
