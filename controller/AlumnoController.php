<?php
require_once 'model/AlumnoModel.php';
require_once 'MateriaCarreraController.php';

class AlumnoController{
  private $alumnoModel;

  public function __construct(){
    $this->alumnoModel = new AlumnoModel();
  }


//Funcion para poder iniciar sesion en la aplicacion
  //La funcion recibe un legajo y verifica si existe en la BD
  //Si el legajo existe setea los datos en Cookies
  public function iniciarSesionAlumno($legajo_alumno){
    $alumnoExiste =  $this->alumnoModel->alumnoExistePorLegajo($legajo_alumno);
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
  public function registrarAlumno($legajo_alumno, $nombre_alumno, $id_carrera){
    $alumnoExiste =  $this->alumnoModel->alumnoExistePorLegajo($legajo_alumno);
    $tupla = mysqli_fetch_assoc($alumnoExiste);
      
    if (isset($tupla) and !empty($tupla)) {
       $_SESSION["registro-alumno"]="YA EXISTE UN ALUMNO REGISTRADO CON ESE LEGAJO";
    } else {
      $this->alumnoModel->agregarAlumno($legajo_alumno, $nombre_alumno, $id_carrera);
       $_SESSION["registro-alumno"]="REGISTRO EXITOSO";
    }
  }


}
