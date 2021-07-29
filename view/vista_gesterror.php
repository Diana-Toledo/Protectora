<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/gesterror.css">
    <title>Error</title>
</head>
<body>
    <header>
        <div class='logo'>
            <img src='' class='anchura100' />
        </div>
		<h1>Nombre de tu dominio.com</h1>
	</header>
		
	<main>
        <?php
            echo $dataError;
        ?>
			
		<div><a href='main'>Ir a la página principal</a></div>
	</main>    
</body>
</html>