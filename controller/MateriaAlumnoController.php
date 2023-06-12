<?php
require_once 'model/MateriaAlumnoModel.php';
require_once 'MateriaCarreraController.php';

class MateriaAlumnoController
{
  private $materiaAlumnoModel;
  private $materiaCarreraController;

  public function __construct(){
    $this->materiaAlumnoModel = new MateriaAlumnoModel();
    $this->materiaCarreraController = new MateriaCarreraController();
  }


  public function leftMenuFuncionMateria(){
    $_SESSION["left-menu-action"] = $_GET["left-menu-action"];
    if(  $_SESSION["left-menu-action"] == "none"){
     $_SESSION["promedio"]="";
      $_SESSION["filtro-materia"]="";
    }
   
  }

  //Esta funcion se encarga de todas las operaciones crud
  public function crudFuncionMateriaAlumnoPost(){
      if ($_POST["crud-action"] == "Agregar") {

        $existe_materia_con_id =$this->materiaCarreraController->materiaExistePorSuId($_POST["id-materia"]);
        if($existe_materia_con_id){
          $this->agregarMateriaAlumno($_SESSION["legajo-alumno"], $_POST["id-materia"], $_POST["nota-materia"]);
        }
      }
  
      if ($_POST["crud-action"] == "Eliminar") {
        $this->eliminarMateriaAlumno($_SESSION["legajo-alumno"], $_POST["id-materia"]);
      }  

  }



  //Esta funcion se encarga de todas las operaciones crud
  public function crudFuncionMateriaAlumnoGet(){

      if ($_GET["crud-action"] == "Filtrar") {
        $filtro_nota= $_GET["nota-menor"].",".$_GET["nota-mayor"];
        $_SESSION["filtro-materia"]=$filtro_nota;
      }

      if ($_GET["crud-action"] == "Promedio") {
        $_SESSION["promedio"]="Promedio";
      }

      if ($_GET["crud-action"] == "mostrartodo") {
        $_SESSION["promedio"]="";
        $_SESSION["filtro-materia"]="";
      }
      
    
  }



  //Funcion para poder agregar una materia junto con su nota a la bd
  //La funcion recibe un legajo y nombre de alumno,id materia y nota de materia
  public function agregarMateriaAlumno($legajo_alumno, $id_materia, $nota_materia){
    $this->materiaAlumnoModel->agregarMateriaAlumno($legajo_alumno, $id_materia, $nota_materia);

  }



  //Obtiene todas las materias de un alumno por su legajo almecenado en la cookie
  public function obtenerTodasMateriasAlumnoPorLegajo(){
    return $this->materiaAlumnoModel->obtenerTodasMateriasAlumnoPorLegajo($_COOKIE["legajo-alumno"]);
  }



  //Eliminar una tupla de la bd
  public function eliminarMateriaAlumno($legajo_alumno, $id_materia){
    $this->materiaAlumnoModel->eliminarMateriaAlumno($legajo_alumno, $id_materia);
  }



//-----------------------------------------------------------------
//-----------------------------------------------------------------
//A partir de esta parte se encuentran todas las funciones encargadas
//de retornar views
//-----------------------------------------------------------------
//-----------------------------------------------------------------

  //Devuelve la view de filtros  
  public function viewFiltrosMateriaAlumno($mostrar){
    include("./view/FiltrosPromediosMateriaAlumnoView.php");
  }
  
  
   //Devuelve la view de funciones de promedio
  public function viewPromediosMateriaAlumno($mostrar){
    include("./view/PromediosMateriasView.php");
  }

  //Devuelve la view de mostrar materias alumno
  //si no hay ningun filtro aplicado va a devolver todas las materias del 
  //alumno. Si hay un filtro lo aplica.
  public function viewMostrarMateriaAlumno(){

    if(isset($_SESSION["filtro-materia"]) and !empty($_SESSION["filtro-materia"])){
    
      $filtro_nota = explode(",", $_SESSION["filtro-materia"]);
      $result_materias = $this->materiaAlumnoModel->obtenerTodasMateriasAlumnoPorNota( $_SESSION["legajo-alumno"],$filtro_nota[0],$filtro_nota[1]);
      include("./view/MostrarMateriasAlumnoView.php");
    
    }else if(isset($_SESSION["promedio"]) and !empty($_SESSION["promedio"]) ){
      
      $result_materias =$this->materiaAlumnoModel->obtenerTodasMateriasAlumnoPorLegajo($_SESSION["legajo-alumno"]);
      include("./view/InformacionYPromediosView.php");
    
    }else{
      $result_materias =$this->materiaAlumnoModel->obtenerTodasMateriasAlumnoPorLegajo($_SESSION["legajo-alumno"]);
      include("./view/MostrarMateriasAlumnoView.php");
    }
      

      
  }
//Devuelve la view de agregar materias alumno
public function viewLeftMenu(){
    include("./view/LeftMenuView.php");
}
  //Devuelve la view de agregar materias alumno
  public function viewAgregarMateriaAlumno(){
    $materias_resultado = $this->materiaCarreraController->obtenerTodasLasNoMateriasAlumno( $_SESSION["legajo-alumno"]);
      include("./view/AgregarMateriaAlumnoView.php");
  }

//Devuelve la view de elimina materias alumno
  public function viewEliminarMateriaAlumno($mostrar){
    $materias_resultado = $this->materiaCarreraController->obtenerTodasLasSiMateriasAlumno( $_SESSION["legajo-alumno"]);
      include("./view/EliminarMateriaAlumnoView.php");
  }


  //Devuelve la view para poder iniciar sesion
  public function viewIniciarSesionAlumno($mostrar){ 
      include("./view/SesionAlumnoView.php");
  }


  //Devuelve la view para poder registrar a un alumno
  public function viewRegistrarAlumno($mostrar){
      include("./view/RegistrarAlumnoView.php");
  }

}
