<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>
<div class= "container"><!--Formulario para login-->
		<?php if(isset($_GET['error'])): ?>
			<div class="alert alert-danger" role="alert">
				pegrilo.
			</div>
		<?php endif ?>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<form class="form" action="validation.php" method="GET"><!--validation todavia no se implementa, utilizar la sumativa 24 ya que se usara la base de datos de usuarios, tanto para crearlos como para ingresar-->
					<div class="form-group">
						<label> Usuario </label>
						<input class="form-control" name="username" />
					</div>
					<div class="form-group">
						<label> Contraseña </label>
						<input type="password" class="form-control" name="password"/>
					</div>
					<button class="btn btn-primary" type="submit"> Enviar </button>
				</form>
			</div>
		</div>
	</div>
<a href="index.php"><button>click para volver al index</button></a>

</body>
</html>