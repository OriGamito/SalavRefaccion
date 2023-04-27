<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
<div class="caja">
    <h2>Login</h2>
    <form id="formulario" name="formulario" method="post">
        <div class="inputcaja">
            <input type="text" id="usuario" name="usuario" required>
            <label for="">User</label>
        </div>

        <div class="inputcaja">
            <input type="password" id="password" name="password" required>
            <label for="">Password</label>
        </div>
        <button type="submit" name="btn" id="btn" value="ingresar" >Ingresar</button>
        <br><br>
        <div id="alerta"></div>
    </form>
</div>
    

    
   <script src="loginscript.js"></script>   

</body>

</html>