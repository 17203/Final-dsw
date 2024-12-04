<?php 

@session_start();

if (isset($_SESSION['is logged']) && $_SESSION['is logged']) {
    echo "Bienvenido a su carrito {$_SESSION['username']}";
} else {
    echo "Sesión no iniciada";
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Carrito</title>
</head>
<body>
</br>
Soy la pagina de carrito, si funciono :D
<a href="index.php"><button>click para volver al index</button></a>


	<h2> Ingresa un producto a la lista </h2>
	<form id="cuerpo">
<div>
	<input id="nombre" type="text" name="nombre">
	<button id="enviar">enviar</button>
</div>
</form>
<div id="lista">
</div>
</p>


 <script type="text/javascript">
        $(document).ready(function() {
            actualizarLista();

            $('#enviar').click(function() {
                var nombre = $('#nombre').val().trim();
                if (nombre) {
                    $.ajax({
                        url: 'carrito_test.php',
                        method: 'GET',
                        data: { nombre: nombre },
                        success: function() {
                            $('#nombre').val(''); 
                            actualizarLista(); 
                        }
                    });
                }
            });
            function actualizarLista() {
                $.ajax({
                    url: 'carrito_test.php',
                    method: 'GET',
                    data: { mostrar: true },
                    success: function(response) {
                        var nombres = JSON.parse(response);
                        var listaHTML = '<h3>Lista de Nombres:</h3><ul>';
                        nombres.forEach(function(nombre) {
                            listaHTML += `<li>${nombre}</li>`;
                        });
                        listaHTML += '</ul>';
                        $('#lista').html(listaHTML);
                    }
                });
            }
        });
    </script>
</body>
</html>