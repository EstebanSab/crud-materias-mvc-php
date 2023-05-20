<?php
require_once 'model/MateriaAlumnoModel.php';

class MateriaAlumnoController
{
  public $materiaAlumnoModel;

  public function __construct(){
    $this->materiaAlumnoModel = new MateriaAlumnoModel();
  }


  //Funcion para poder iniciar sesion en la aplicacion
  //La funcion recibe un legajo y verifica si existe en la BD
  //Si el legajo existe setea los datos en Cookies
  public function iniciarSesionAlumno($legajo_alumno){
    $alumnoExiste =  $this->materiaAlumnoModel->alumnoExistePorLegajo($legajo_alumno);
    $tupla = mysqli_fetch_assoc($alumnoExiste);
    $minutos = 5 * 60;

    if (isset($tupla) and !empty($tupla)) {
      //$cookie_name = "legajo-alumno";
      //$cookie_value = $legajo_alumno;
      //setcookie($cookie_name, $cookie_value, time() + $minutos, "/");
      
      //$cookie_name = "nombre-alumno";
      //$cookie_value = $tupla["nombre_alumno"];
      //setcookie($cookie_name, $cookie_value, time() + $minutos, "/");

      $_SESSION["legajo-alumno"] =  $legajo_alumno;
      $_SESSION["nombre-alumno"] =  $tupla["nombre_alumno"];
      
    } 
  }

  //Funcion para poder cerrar sesion en la aplicacion
  //La funcion borra el tiempo de la cookies 
  public function cerrarSesion(){
    //setcookie("legajo-alumno", "", time() + 1, "/");
    //setcookie("nombre-alumno", "", time() + 1, "/");
    session_destroy();
  }

  //Funcion para poder registrar un alumno en la aplicacion
  //La funcion recibe un legajo y nombre de alumno
  //verifica que no exista ya una tupla con ese legajo
  //si no exite inserta una tupla con datos en 0
  //si ya existe una tupla con ese legajo no hace nada
  public function registrarAlumno($legajo_alumno, $nombre_alumno){
    $alumnoExiste =  $this->materiaAlumnoModel->alumnoExistePorLegajo($legajo_alumno);
    $tupla = mysqli_fetch_assoc($alumnoExiste);

    if (isset($tupla) and !empty($tupla)) {
      echo "Este legajo ya esta registrado";
    } else {
      $this->materiaAlumnoModel->agregarMateriaAlumno($legajo_alumno, $nombre_alumno, 0, 0);
      echo "Registro Exitoso";
    }
  }

  //Esta funcion se encarga de todas las operaciones crud
  public function crudFuncionMateriaAlumnoPost(){
      if ($_POST["crud-action"] == "Agregar") {
        $this->agregarMateriaAlumno($_SESSION["legajo-alumno"], $_SESSION["nombre-alumno"], $_POST["id-materia"], $_POST["nota-materia"]);
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
  public function agregarMateriaAlumno($legajo_alumno, $nombre_alumno, $id_materia, $nota_materia){
    $this->materiaAlumnoModel->agregarMateriaAlumno($legajo_alumno, $nombre_alumno, $id_materia, $nota_materia);

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

  //Devuelve la view de filtros y funciones de promedio
  public function viewFiltrosPromediosMateriaAlumno($mostrar){
    include("./view/FiltrosPromediosMateriaAlumnoView.php");
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
  public function viewAgregarMateriaAlumno(){
      include("./view/AgregarMateriaAlumnoView.php");
  }

//Devuelve la view de elimina materias alumno
  public function viewEliminarMateriaAlumno($mostrar){
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
