<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fragancia 2</title>
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
      		<button><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
</svg>Carrito</button><!--Este lo hice con boostrap, cambienlo si quieren-->
  		</form>
    </div>
  </div>
  <div class="row"id="test1"><!--Barra de decoracion -->
    <div class="col">
      :D
    </div>
  </div>
  <div class="row"id="test1"><!--pagina -->
    <div class="col-md-2" id="test2"><!--Opciones de catalogo -->
      <a href="acondicionadores.php">Acondicionadores</a></br>
      <a href="shampoo.php">Shampoo</a></br>
      <a href="jabones.php">Jabones</a></br>
      <a href="fragancias.php">Fragancias 1</a></br><!--Luego decidir como ponerle(Hombre y mujer, masculino y femenino, etc)-->
      <a href="fragancias2.php">Fragancias 2</a></br>
    </div>
    <div class="col-md-10" id="test2"><!--catalogo-->
    	<div class="row" id="test1">
      <div class="col-md-3" id="test2">
      	<div class="card" style="width:12rem;"><!--este es igual a los otros 4, usenlo como referencia para modificar los demás-->
  			<img src="..." class="card-img-top" alt="Fragancias 1"><!--Aquí ponen la imagen, y el nombre del producto-->
  			<div class="card-body">
   			<h5 class="card-title">Ejemplo de producto</h5><!--Titulo principal del producto-->
    		<p class="card-text">Aquí va toda la información sobre este</p><!--Precio, nombre, información y demás-->
    		<a href="#" class="btn btn-primary">Este boton lo agregaria al carrito</a><!--Usa el a para enviarlo al carrito, luego resuelvo el como agregarlo-->
  			</div>
		</div>
      </div>
      <div class="col-md-3" id="test2">
      	<div class="card" style="width:12rem;">
  			<img src="..." class="card-img-top" alt="Fragancias 2">
  			<div class="card-body">
   			<h5 class="card-title">Ejemplo de producto</h5>
    		<p class="card-text">Aquí va toda la información sobre este</p>
    		<a href="#" class="btn btn-primary">Este boton lo agregaria al carrito</a>
  			</div>
		</div>
      </div>
      <div class="col-md-3" id="test2">
      <div class="card" style="width:12rem;">
  			<img src="..." class="card-img-top" alt="Fragancias 3">
  			<div class="card-body">
   			<h5 class="card-title">Ejemplo de producto</h5>
    		<p class="card-text">Aquí va toda la información sobre este</p>
    		<a href="#" class="btn btn-primary">Este boton lo agregaria al carrito</a>
  			</div>
		</div>
      </div>
      <div class="col-md-3" id="test2">
      	<div class="card" style="width:12rem;">
  			<img src="..." class="card-img-top" alt="Fragancias 4">
  			<div class="card-body">
   			<h5 class="card-title">Ejemplo de producto</h5>
    		<p class="card-text">Aquí va toda la información sobre este</p>
    		<a href="#" class="btn btn-primary">Este boton lo agregaria al carrito</a>
  			</div>
		</div>
      </div>
  </div>
    </div>
</div>
<a href="index.php"><button>click para volver al index</button></a>

</body>
</html>