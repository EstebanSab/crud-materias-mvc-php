<?php require_once './config/config.php';?> 

 <div class="contanainer-filtro-materia">
  <h2>Filtros</h2> 
    <form class="form" action=<?php echo constant('BASE_URL')."/request.php"?> method="GET">
      <div class="filtro-materia-inputs"> 
        <h3>Materia por Nota</h3>
        <div class="filtro-materia-inputs-nota-menor">
          <input type="number" name="nota-menor" min="1" max="10" id="nota-menor" placeholder="Minimo">
        </div>

        <div class="filtro-materia-inputs-nota-mayor">
          <input type="number" name="nota-mayor" min="1" max="10" id="nota-mayor" placeholder="Maximo">
        </div>

        <div class="filtro-materia-inputs-submit">
        <input type="submit" value="Filtrar" name="crud-action"/>
        </div>
      
      </div>    
    </form>
<div class="contanainer-promedio">
    <form class="form" action=<?php echo constant('BASE_URL')."/request.php"?> method="GET">
        <h3>Promedio del alumno</h3>
        <div>
           <input type="submit" value="Promedio" name="crud-action"/>
        </div>
    </form>
 </div>
  </div>
