<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pokedex</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="..\wwwroot\css\estilosLogueado.css">
    <link rel="stylesheet" href="..\wwwroot\lib\bootstrap\css\bootstrap.min.css">
    <script src="..\wwwroot\lib\jquery.js"></script>
    <script src="..\wwwroot\lib\bootstrap\js\bootstrap.min.js"></script>
</head>

<body>
    <img src="../wwwroot/img/pokemon.png" class="img-fluid" />

    <?php
    include("../Helpers/Conexion.php");
    include("../Helpers/Funciones.php");

    session_start();

    $conexion = new Conexion("ezequiel", "ezequiel", "pokemonsAllioEzequiel");

    $user = $_SESSION['user'];

    echo "<div class='d-md-flex'><form action='' method='POST' class='d-flex buscador m-2'>
    <input type='text' name='search' class='form-control' placeholder='Buscar...'/>
    <input type='submit' value='Buscar' class='btn btn-secondary ml-1 mb-3'/>
    </form>
    <div class='iniciocierre d-flex'>
        <button type='button' class='btn btn-secondary mt-2 m-2 mb-4 d-flex w-100 justify-content-center' data-toggle='modal' data-target='#alta'>Añadir Pokemon</button>
        <form action='../index.php' method='POST'>
        <input type='submit' class='btn btn-secondary mt-2 m-2 d-flex w-100' name='cerrar' value='Cerrar Sesion' />
        </form></div></div>

                <div class='modal fade' id= 'alta' tabindex= '-1' role='dialog' aria-labelledby='personaje' aria-hidden='true'>
                    <div class= 'modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLongTitle'>Añadir</h5>
                            <button type ='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <form action='' method='POST' enctype='multipart/form-data'>
                                <input type='text' required class='form-control' name='nombre' placeholder='Nombre'/><br>
                                <select required name='tipo1' class='form-control'>
                                <option disabled selected>Tipo(Obligatorio)</option>
                                <option>Acero</option>
                                <option>Agua</option>
                                <option>Bicho</option>
                                <option>Dragón</option>
                                <option>Eléctrico</option>
                                <option>Fantasma</option>
                                <option>Fuego</option>
                                <option>Hada</option>
                                <option>Hielo</option>
                                <option>Lucha</option>
                                <option>Normal</option>
                                <option>Planta</option>
                                <option>Psíquico</option>
                                <option>Roca</option>
                                <option>Siniestro</option>
                                <option>Tierra</option>
                                <option>Veneno</option>
                                <option>Volador</option>
                                <option>Desconocido</option>
                                </select><br>
                                <select name='tipo2' class='form-control'>
                                <option disabled selected>Tipo</option>
                                <option>Acero</option>
                                <option>Agua</option>
                                <option>Bicho</option>
                                <option>Dragón</option>
                                <option>Eléctrico</option>
                                <option>Fantasma</option>
                                <option>Fuego</option>
                                <option>Hada</option>
                                <option>Hielo</option>
                                <option>Lucha</option>
                                <option>Normal</option>
                                <option>Planta</option>
                                <option>Psíquico</option>
                                <option>Roca</option>
                                <option>Siniestro</option>
                                <option>Tierra</option>
                                <option>Veneno</option>
                                <option>Volador</option>
                                <option>Desconocido</option>
                                </select><br>
                                <input type='file' required name='imagen' class='form-control-file'/><br>
                                <input type='submit' value='Confirmar' name='agregar' class='btn btn-secondary'>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
        ";

    $query = "SELECT ID FROM Pokemon";
    $resultado = $conexion->ejecutarQuery($query);

    while ($total = $conexion->getFila($resultado))
    {
        if(isset($_POST["$total[0]"]))
        {
            eliminar($total[0], $conexion);
            break;
        }
    }

    if (isset($_POST["agregar"]))
    {
        $_SESSION["nombreP"] = $_POST["nombre"];
        $_SESSION["imagen"] = $_FILES["imagen"]["name"];
        $_SESSION["temp_nombre"] = $_FILES["imagen"]["tmp_name"];
        $_SESSION["tipo1"] = $_POST["tipo1"];
        $_SESSION["tipo2"] = isset($_POST["tipo2"])?$_POST["tipo2"]:"";
        agregar($conexion);
    }

    if(isset($_POST["modificar"]))
    {
        $_SESSION["id"] = $_POST["id"];
        $_SESSION["t1v"] = $_POST["tipo1v"];
        $_SESSION["t2v"] = $_POST["tipo2v"];
        $_SESSION["nombrev"] = $_POST["nombrev"];

        $_SESSION["nombreP"] = $_POST["nombreP"];

        if(isset($_FILES["imagen"]))
        {
            $_SESSION["imagen"] = $_FILES["imagen"]["name"];
            $_SESSION["temp_nombre"] = $_FILES["imagen"]["tmp_name"];
            $_SESSION["imagenv"] = $_POST["imagenv"];
        }
        else
            $_SESSION["imagen"] = "";

        $_SESSION["tipo1"] = $_POST["tipo1"];
        $_SESSION["tipo2"] = isset($_POST["tipo2"])?$_POST["tipo2"]:"";

        modificar($conexion);
    }

    if (!isset($_POST["search"]))
        mostrarABM($conexion);
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

                $tipo1v = $fila3[1];
                $tipo2v = "";

                $tipos = array("Acero", "Agua", "Bicho", "Dragón", "Eléctrico", "Fantasma", "Fuego", "Hada", "Hielo", "Lucha", "Normal", "Planta", "Psíquico", "Roca", "Siniestro", "Tierra", "Veneno", "Volador", "Desconocido");

                echo "<a href='' data-toggle='modal' class='text-warning ml-5' id='textoP' data-target='#personaje'>$fila1[1]</a> <img src='../wwwroot/img/Tipos/$fila3[2]' class='ml-5' id='tipoP'/>
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
                                <img src='../wwwroot/img/Pokemons/$fila1[2]' class='w-100 h-100'/>
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

                    $tipo2v = $fila3[1];

                    echo " <img src='../wwwroot/img/Tipos/$fila3[2]' />";
                }

                $mostrar = "<div class='d-flex float-right mr-3' id='botones'><button type='button' class='btn btn-secondary mr-2' data-toggle='modal' data-target='#m$fila2[1]'>Modificar</button>
                <div class='modal fade' id= 'm$fila2[1]' tabindex= '-1' role='dialog' aria-labelledby='personaje' aria-hidden='true'>
                    <div class= 'modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLongTitle'>Modificar</h5>
                            <button type ='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <form action='' method='POST' enctype='multipart/form-data'>
                                <input type='text' required class='form-control' name='nombreP' placeholder='Nombre' value='$fila1[1]'/><br>
                                <input type='hidden' name='id' value='$fila1[0]'/>
                                <input type='hidden' name='tipo1v' value='$tipo1v'/>
                                <input type='hidden' name='tipo2v' value='$tipo2v'/>
                                <input type='hidden' name='nombrev' value='$fila1[1]'/>
                                <input type='hidden' name='imagenv' value='$fila1[2]'/>
                                <select name='tipo1' class='form-control'>
                                <option disabled>Tipo</option>";
                                
                                foreach($tipos as $tipo)
                                {
                                    $select = $tipo==$tipo1v?"selected":"";
                                    $mostrar .= "<option $select>$tipo</option>";
                                }
                        
                                $mostrar .= "</select><br>
                                <select name='tipo2' class='form-control'>";

                                if($tipo2v != "")
                                {
                                    $vacio = "";
                                    $mostrar .= "<option disabled>Tipo</option>
                                    <option>$vacio</option>";

                                    foreach($tipos as $tipo)
                                    {
                                        $select = $tipo==$tipo2v?"selected":"";
                                        $mostrar .= "<option $select>$tipo</option>";
                                    }
                                }
                                else
                                {
                                    $mostrar .= "<option disabled selected>Tipo</option>
                                    <option>Acero</option>
                                    <option>Agua</option>
                                    <option>Bicho</option>
                                    <option>Dragón</option>
                                    <option>Eléctrico</option>
                                    <option>Fantasma</option>
                                    <option>Fuego</option>
                                    <option>Hada</option>
                                    <option>Hielo</option>
                                    <option>Lucha</option>
                                    <option>Normal</option>
                                    <option>Planta</option>
                                    <option>Psíquico</option>
                                    <option>Roca</option>
                                    <option>Siniestro</option>
                                    <option>Tierra</option>
                                    <option>Veneno</option>
                                    <option>Volador</option>
                                    <option>Desconocido</option>";
                                }
                                $mostrar .= "</select><br>
                                <input type='file' name='imagen' class='form-control-file'/><br>
                                <input type='submit' value='Confirmar' name='modificar' class='btn btn-secondary'>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                
                <form action='' method='POST'>
                <input type='submit' name='$fila1[0]' value='Eliminar' class='btn btn-secondary'>
                </form></div><br><br>";

                echo $mostrar;
            } else {
                echo "<div class='alert alert-danger ml-2 mr-2'>
                <strong>Error!</strong> Pokemon no encontrado
              </div>";
                mostrarABM($conexion);
            }
        } else {
            echo "<div class='alert alert-danger ml-2 mr-2'>
            <strong>Error!</strong> Debe ingresar un pokemon válido
          </div>";
            mostrarABM($conexion);
        }
    }

    ?>
</body>

</html>