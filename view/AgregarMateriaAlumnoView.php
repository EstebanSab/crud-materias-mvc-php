<?php require_once './config/config.php';?> 

<div class="contanainer-agregar-materia">
  <form class="form" action=<?php echo constant('BASE_URL')."/request.php"?> method="POST">
    <div class="agregar-materia-inputs">
        <div  class="agregar-materia-inputs-select" >
          <select name="id-materia" id="id-materia">
          <option value="">Seleccionar Materia</option>
          <?php  while($row = mysqli_fetch_assoc($materias_resultado)) { ?>
          <option value=<?php echo $row['id_materia']; ?>><?php echo $row['nombre_materia']; ?></option>
          <?php } ?>
          </select>
        </div>
        
        <div class="agregar-materia-inputs-nota">  
             <input type="number" name="nota-materia" id="nota-materia" min="1" max="10" placeholder="Nota" required>
        </div>

        <div class="agregar-materia-inputs-submit">
            <input type="submit" value="Agregar" name="crud-action"/>
        </div>
      </div>
  </form>
 </div>
    
  
