

<?php require_once('includes/header.php');?>
 
 
  <br>

  <?php
  require_once("controller/MateriaAlumnoController.php");
  $materiaAlumnoController = new MateriaAlumnoController();
  
  //$materiaAlumnoController->insertarDatosAlumno("pablo", 21);
  //$materiaAlumnoController->insertarMateriaAlumno(14, 7);


  $mostrarAgregar  = true;
  $mostrarListar  = true;
  
  $materiaAlumnoController->viewAgregarMateriaAlumno($mostrarAgregar);
  $materiaAlumnoController->viewListarMateriaAlumno($mostrarListar);
  
 
      
     echo "<br><br>";
   
      
      if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["crud-action"])){
        //echo implode("----",$_POST);
        if($_POST["crud-action"] == "Crear"){
          $materiaAlumnoController->agregarMateriaAlumno($_POST["legajo-alumno"],$_POST["nombre-alumno"],$_POST["id-materia"], $_POST["nota-materia"]);
          header('Location: index.php');
        } 

        if($_POST["crud-action"] == "Eliminar"){
          echo "holi------------------------------------";
        } 
      } 

     
    
//if(isset($_GET["controller"]) and isset( $_GET["action"]) and $_GET["action"]=="listar" and isset( $_GET["listado"]) ){
//    if($_GET["listado"]){
//      $materiaAlumnoController->funcionTestView(true);
//      $mostrarListar =false;
//    }else{
//      $mostrarListar=true;
//    }
//    }?>
      
      <input type="button" onclick="location='view/insertMateria.php'" />
      <a href=<?php echo constant('BASE_URL')."/index.php?controller=materia&action=listar&listado=".$mostrarListar?>>Listar</a>
    </body> 
</html>