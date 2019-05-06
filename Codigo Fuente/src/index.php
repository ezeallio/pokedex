<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pokedex</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=".\wwwroot\css\estilos.css">
    <link rel="stylesheet" href=".\wwwroot\lib\bootstrap\css\bootstrap.min.css">
    <script src=".\wwwroot\lib\jquery.js"></script>
    <script src=".\wwwroot\lib\bootstrap\js\bootstrap.min.js"></script>
</head>

<body>

    <img src="./wwwroot/img/pokemon.png" class="img-fluid" />

<div class="d-md-flex">
    <form action="" method="POST" class="d-flex m-2 buscar">
        <input type="text" name="search" class="form-control" placeholder="Buscar..."/>
        <input type="submit" value="Buscar" class="btn btn-secondary mb-4 ml-1"/>
    </form>

    <form action="" method="POST" class="d-md-flex m-2 logueo">
        <input type="text" name="usuario" placeholder="Usuario" class="form-control mb-2 mr-1"/>
        <input type="password" name="password" placeholder="Contraseña" class="form-control mb-2 mr-1"/>
        <input type="submit" value="Loguearse" class="btn btn-secondary w-100 mb-4"/>
    </form>
</div>

    <?php
    include("./Helpers/Conexion.php");
    include("./Helpers/Funciones.php");

    $conexion = new Conexion("ezequiel", "ezequiel", "pokemonsAllioEzequiel");

    if(isset($_POST["usuario"]) && isset($_POST["password"]))
    {
        if($_POST && !empty($_POST["usuario"]) && !empty($_POST["password"]))
        {
            $pass = sha1($_POST["password"]);
            $user = $_POST["usuario"];
    
            $query = "SELECT Username, UPassword FROM Usuario
            WHERE Username LIKE '$user' AND UPassword LIKE '$pass'";       
    
            $resultado = $conexion->ejecutarQuery($query);
    
            if($conexion->getFila($resultado))
            {
                session_start();
                $_SESSION["user"] = $user;
                header("location: ./Views/logueado.php");
            }
            else
                echo "<div class='alert alert-danger ml-2 mr-2'>
                <strong>Error!</strong> Usuario y/o Contraseña incorrecta/s
              </div>";
        }
        else
            echo "<div class='alert alert-danger ml-2 mr-2'>
            <strong>Error!</strong> Campo incompletos
          </div>";
    }

    if(isset($_POST["cerrar"]))
        {
            session_start();
            session_destroy();
        }

    if (!isset($_POST["search"]))
        mostrarTodo($conexion);
    else {
        if ($_POST && !empty($_POST["search"])) {
            $busqueda = $_POST["search"];
            $query1 = "SELECT * FROM Pokemon WHERE Nombre LIKE '$busqueda'";
            $resultado1 = $conexion->ejecutarQuery($query1);

            if ($fila1 = $conexion->getFila($resultado1)) {
                $query2 = "SELECT * FROM TipoPokemon WHERE ID_Pokemon = $fila1[0]";
                $resultado2 = $conexion->ejecutarQuery($query2);
                $fila2 = $conexion->getFila($resultado2);

                $query3 = "SELECT * FROM Tipo WHERE ID = $fila2[0]";
                $resultado3 = $conexion->ejecutarQuery($query3);
                $fila3 = $conexion->getFila($resultado3);

                $registro = "<a href='' data-toggle='modal' class='text-warning ml-5' data-target='#personaje'>$fila1[1]</a> <img src='./wwwroot/img/Tipos/$fila3[2]' class='ml-5'/>
                <div class='modal fade' id= 'personaje' tabindex= '-1' role='dialog' aria-labelledby= 'exampleModalCenterTitle' aria-hidden='true'>
                    <div class= 'modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLongTitle'>$fila1[1]</h5>
                            <button type ='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>

                        <div class='row'>

                        <div class='col'>
                            <img src='./wwwroot/img/Pokemons/$fila1[2]' class='w-100 h-100' />
                        </div>

                        <div class='col'>
                            <p class='text-justify'>Lorem ipsum dolor sit amet consectetur adipiscing elit vel lacinia, fusce leo lobortis vestibulum habitant suspendisse ultricies sodales, turpis lectus convallis et dis ridiculus nam proin.</p>
                        </div>

                        </div>

                        </div>
                        </div>
                    </div>
                    </div>
                ";

                if ($fila2 = $conexion->getFila($resultado2)) {
                    $query3 = "SELECT * FROM Tipo WHERE ID = $fila2[0]";
                    $resultado3 = $conexion->ejecutarQuery($query3);
                    $fila3 = $conexion->getFila($resultado3);

                    $registro .= " <img src='./wwwroot/img/Tipos/$fila3[2]'/>";
                }
                
                echo $registro;
            } else {
                echo "<div class='alert alert-danger ml-2 mr-2'>
                <strong>Error!</strong> Pokemon no encontrado
              </div>";
                mostrarTodo($conexion);
            }
        } else {
            echo "<div class='alert alert-danger ml-2 mr-2'>
            <strong>Error!</strong> Debe ingresar un pokemon válido
          </div>";
            mostrarTodo($conexion);
        }
    }

    ?>

</body>

</html>