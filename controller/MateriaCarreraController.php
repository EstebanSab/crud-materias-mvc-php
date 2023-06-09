<?php
require_once 'model/MateriaCarreraModel.php';

class MateriaCarreraController{
  public $materiaCarreraModel;

  public function __construct(){
    $this->materiaCarreraModel = new MateriaCarreraModel();
  }

  public function  agregarMateriaCarrera($id_materia,$nombre_materia, $correlativas) {
    $this->materiaCarreraModel->agregarMateriaCarrera($id_materia,$nombre_materia, $correlativas);
  }

  public function  materiaExistePorSuId($id_materia) {
    $materia_existe = $this->materiaCarreraModel->obtenerMateriaPorId($id_materia);
    $tupla = mysqli_fetch_assoc($materia_existe);
    return (isset($tupla) and !empty($tupla)); 
  }
  public function  obtenerMateriaPorId($id_materia){
    $materia = $this->materiaCarreraModel->obtenerMateriaPorId($id_materia);
    return $materia;
  }



  public function  obtenerTodasMaterias(){
    return $this->materiaCarreraModel->obtenerTodasMaterias();
  }

  public function obtenerTodasLasNoMateriasAlumno($legajo_alumno){
    return $this->materiaCarreraModel->obtenerTodasLasNoMateriasAlumno($legajo_alumno);
  }


  public function obtenerTodasLasSiMateriasAlumno($legajo_alumno){
    return $this->materiaCarreraModel->obtenerTodasLasSiMateriasAlumno($legajo_alumno);
  }
}

?>