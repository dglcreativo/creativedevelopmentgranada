<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Creative Editor Granada</title>
	<link rel="stylesheet" href="css/estilos.css">    
</head>
<body>
	<div id="head-editor" class="limpiar">
		<div id="logo">
            <img src="images/logotipo.png" alt="Academía Creative Development Granada">
            <h4>CdG</h4>
        </div>
        <div id="container-buttons">
            <div class="boton activo" id="html">HTML</div>
            <div class="boton" id="css">CSS</div>
            <div class="boton" id="javascript">JavaScript</div>
            <div class="boton activo" id="output">Output</div>
        </div>
        <div id="saveload-buttons">
        	<form action="">
        		<button type="submit" class="btn-foot">Guardar</button>
        		<button type="submit" class="btn-foot">Cargar</button>
        	</form>
        </div>
	</div>
	<div id="container-panel">          
        <textarea id="htmlPanel" class="pnl"></textarea>
        <textarea id="cssPanel" class="pnl nv"></textarea>
        <textarea id="javascriptPanel" class="pnl nv"></textarea>

        <iframe id="outputPanel" class="pnl"></iframe>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/editor.js"></script>
</body>
</html>