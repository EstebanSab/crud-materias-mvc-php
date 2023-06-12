<?php require_once './config/config.php';?> 

 <div class="contanainer-eliminar-materia">
    <form class="form" action=<?php echo constant('BASE_URL')."/request.php"?> method="POST">
      <div class="eliminar-materia-inputs"> 
         <div >
          <select name="id-materia" id="id-materia">
          <option value="">Seleccionar Materia</option>
          <?php  while($row = mysqli_fetch_assoc($materias_resultado)) { ?>
          <option value=<?php echo $row['id_materia']; ?>><?php echo $row['nombre_materia']; ?></option>
          <?php } ?>
          </select>
        </div>

        <div>
        <input type="submit" value="Eliminar" name="crud-action"/>
        </div>
      
      </div>    
    </form>
  </div>
