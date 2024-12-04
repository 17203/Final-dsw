<?php 

@session_start();

if (isset($_SESSION['is logged']) && $_SESSION['is logged']) {
    echo "Sesión iniciada por {$_SESSION['username']}";
} else {
    echo "Sesión no iniciada";
}

?>

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
      <input type="text" placeholder="Buscar en la pagina">
      <button>Imagen </button>
    </div>
    <div class="col" id="test2"><!--Opciones varias-->


      		<button><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16"><!--Este lo hice con boostrap, cambienlo si quieren-->
  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
</svg><a href="carrito.php">Carrito</a></button>
<?php if (isset($_SESSION['is logged']) && $_SESSION['is logged']): ?>
    <!-- Este botón solo es visible cuando hay una sesión iniciada -->
    <button><a href="perfil.php">Perfil</a></button>
    <button class="btn btn-danger">
        <a href="logout.php" style="text-decoration: none; color: white;">Logout</a>
    </button>
<?php else: ?>
    <!-- Este botón es visible cuando no hay una sesión iniciada -->
    <button><a href="login.php">Login</a></button>
<?php endif; ?>
  		</form>
    </div>
  </div>
  <div class="row"id="test1"><!--Barra de decoracion -->
    <div class="col">
      :D
    </div>
  </div>
  <div class="row"id="test1"><!--pagina -->
    <div class="col-md" id="test2"><!--catalogo-->
      <a href="pagina_general.php">Acondicionadores<?phpheader('Location: index.php?acondicionadores=true');?></a></br>
      <a href="shampoo.php">Shampoo</a></br>
      <a href="jabones.php">Jabones</a></br>
      <a href="fragancias.php">Fragancias 1</a></br><!--Luego decidir como ponerle(Hombre y mujer, masculino y femenino, etc)-->
      <a href="fragancias2.php">Fragancias 2</a></br>
    </div>
</div>
</div>
</body>
</html>
