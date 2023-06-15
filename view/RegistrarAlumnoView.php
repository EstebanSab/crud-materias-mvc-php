<?php require_once './config/config.php';?> 

<div class="register-layout">

  <form class="form" action=<?php echo constant('BASE_URL')."/request.php"?> method="POST">
    <div style="text-align:center;">
        <h1>Registrar Alumno</h1>
        <div>
          <input type="number" name="legajo-alumno"  placeholder="Legajo Alumno" min="1" required>
        </div>

        <div>
          <input type="text" name="nombre-alumno" placeholder="Nombre Alumno" maxlength="30" required >
        </div>


        <div>
          <input type="number" name="id-carrera" placeholder="Id Carrera" min="1" required>
        </div>

        <input type="submit" value="Registrar" name="registrar-alumno" />
      </div>
      </form>
        <?php 
              if(isset($_SESSION["registro-alumno"])  ) {?>
          <div style="color:red;">
           <?php 
              echo $_SESSION["registro-alumno"];}
            ?>
          </div>
    </div>
