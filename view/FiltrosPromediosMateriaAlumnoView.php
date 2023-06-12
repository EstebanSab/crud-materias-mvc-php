<?php require_once './config/config.php';?> 

 <div class="contanainer-filtro-materia">
    <form class="form" action=<?php echo constant('BASE_URL')."/request.php"?> method="GET">
      <div class="filtro-materia-inputs"> 
        <h3>Materia por Nota</h3>
        <div class="filtro-materia-inputs-nota-menor">
          <input type="number" name="nota-menor" min="1" max="10" id="nota-menor" placeholder="Minimo" required> 
        </div>

        <div class="filtro-materia-inputs-nota-mayor">
          <input type="number" name="nota-mayor" min="1" max="10" id="nota-mayor" placeholder="Maximo" required>
        </div>

        <div class="filtro-materia-inputs-submit">
        <input type="submit" value="Filtrar" name="crud-action"/>
        </div>
      
      </div>    
    </form>

  </div>
