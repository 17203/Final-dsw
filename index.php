<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Olores-electos</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<style type="text/css">
	#test1{
		border-width: 5px;
		border-style: solid;
		border-color: black;
		padding: 20px;
	}
	#test2{
		border-width: 5px;
		border-style: solid;
		border-color: blue;
		padding: 20px;
	}

</style>

</head>
<body>
 <div class="container text-center">
  <div class="row" id="test1"><!--Barra de decoracion -->
    <div class="col" id="test2">
      Decoración
    </div>
  </div>
  <div class="row"id="test1"><!--Titular principal -->
    <div class="col" id="test2"><!--Imagen de regreso, en este caso no lleva a ningun lado ya que es el index. Dentro de las categorias este formato de cabecera no desaparecera por lo que dentro de estas, esta imagen se utilizara para regresar al index-->
      Imagén
    </div>
    <div class="col" id="test2"><!--Barra de busqueda-->
      Barra de busqueda
    </div>
    <div class="col" id="test2"><!--Opciones varias-->
    	<form class="form" action="login.php" method="GET">
      		<button>Login </button>
  		</form>
  		<form class="form" action="perfil.php" method="GET">
      		<button>perfil </button>
  		</form>
  		<form class="form" action="carrito.php" method="GET">
      		<button>carrito </button>
  		</form>
    </div>
  </div>
  <div class="row"id="test1"><!--Barra de decoracion -->
    <div class="col">
      :D
    </div>
  </div>
  <div class="row"id="test1"><!--pagina -->
    <div class="col-md-3" id="test2"><!--Opciones de catalogo -->
      <a href="acondicionadores.php">Acondicionadores</a></br>
      <a href="shampoo.php">Shampoo</a></br>
      <a href="jabones.php">Jabones</a></br>
      <a href="fragancias.php">Fragancias 1</a></br><!--Luego decidir como ponerle(Hombre y mujer, masculino y femenino, etc)-->
      <a href="fragancias2.php">Fragancias 2</a></br>
    </div>
    <div class="col-md-9" id="test2"><!--catalogo-->
      Catalogo, divido en 4 cuadriculas para pantallas grandes, en 2 para pantallas chicas.</br>
      Se necesita poner en display la imagen del producto, su precio, nombre</br>
      Boton para más detalles y para agregar al carro </br>
    </div>
</div>
</body>
</html>