<?php

function mostrarTodo($conexion)
{
    $query1 = "SELECT * FROM TipoPokemon";
    $resultado1 = $conexion->ejecutarQuery($query1);
    
    $fila = $conexion->getFila($resultado1);
    $i = $fila[1];

    do{
        $query2 = "SELECT * FROM Pokemon WHERE ID = $fila[1]";
        $resultado2 = $conexion->ejecutarQuery($query2);
        $fila2 = $conexion->getFila($resultado2);

        $query3 = "SELECT * FROM Tipo WHERE ID = $fila[0]";
        $resultado3 = $conexion->ejecutarQuery($query3);
        $fila3 = $conexion->getFila($resultado3);

        $registro = "<a href='' data-toggle='modal' class='text-warning ml-5' data-target='#$fila2[1]'>$fila2[1]</a> <img src='./wwwroot/img/Tipos/$fila3[2]' class='ml-5'/>
                <div class='modal fade' id= '$fila2[1]' tabindex= '-1' role='dialog' aria-labelledby='personaje' aria-hidden='true'>
                    <div class= 'modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLongTitle'>$fila2[1]</h5>
                            <button type ='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>

                        <div class='row'>

                        <div class='col'>
                            <img src='./wwwroot/img/Pokemons/$fila2[2]' class='w-100 h-100'/>
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

        $fila = $conexion->getFila($resultado1);

        if($fila && ($i == $fila[1]))
        {
            $query3 = "SELECT * FROM Tipo WHERE ID = $fila[0]";
            $resultado3 = $conexion->ejecutarQuery($query3);
            $fila3 = $conexion->getFila($resultado3);

            $registro .= " <img src='./wwwroot/img/Tipos/$fila3[2]'/>";

            $fila = $conexion->getFila($resultado1);
        }

        echo $registro."<br><br>";

        $fila?$i = $fila[1]:'';
        
    }while($fila);
}

function mostrarABM($conexion)
{
    $tipos = array("Acero", "Agua", "Bicho", "Dragón", "Eléctrico", "Fantasma", "Fuego", "Hada", "Hielo", "Lucha", "Normal", "Planta", "Psíquico", "Roca", "Siniestro", "Tierra", "Veneno", "Volador", "Desconocido");
    $query1 = "SELECT * FROM TipoPokemon";
    $resultado1 = $conexion->ejecutarQuery($query1);
    
    $fila = $conexion->getFila($resultado1);
    $i = $fila[1];

    do{
        $query2 = "SELECT * FROM Pokemon WHERE ID = $fila[1]";
        $resultado2 = $conexion->ejecutarQuery($query2);
        $fila2 = $conexion->getFila($resultado2);

        $query3 = "SELECT * FROM Tipo WHERE ID = $fila[0]";
        $resultado3 = $conexion->ejecutarQuery($query3);
        $fila3 = $conexion->getFila($resultado3);

        $tipo1v = $fila3[1];
        $tipo2v = "";

        echo "<a href='' data-toggle='modal' class='text-warning ml-5' id='textoP' data-target='#$fila2[1]'>$fila2[1]</a> <img src='../wwwroot/img/Tipos/$fila3[2]' class='ml-5' id='tipoP'/>
                <div class='modal fade' id= '$fila2[1]' tabindex= '-1' role='dialog' aria-labelledby='personaje' aria-hidden='true'>
                    <div class= 'modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLongTitle'>$fila2[1]</h5>
                            <button type ='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>

                        <div class='row'>

                        <div class='col'>
                            <img src='../wwwroot/img/Pokemons/$fila2[2]' class='w-100 h-100'/>
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

        $fila = $conexion->getFila($resultado1);

        if($fila && ($i == $fila[1]))
        {
            $query3 = "SELECT * FROM Tipo WHERE ID = $fila[0]";
            $resultado3 = $conexion->ejecutarQuery($query3);
            $fila3 = $conexion->getFila($resultado3);

            echo " <img src='../wwwroot/img/Tipos/$fila3[2]'/>";

            $fila = $conexion->getFila($resultado1);

            $tipo2v = $fila3[1];
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
                        <input type='hidden' name='id' value='$fila2[0]'/>
                        <input type='hidden' name='tipo1v' value='$tipo1v'/>
                        <input type='hidden' name='tipo2v' value='$tipo2v'/>
                        <input type='hidden' name='nombrev' value='$fila2[1]'/>
                        <input type='hidden' name='imagenv' value='$fila2[2]'/>
                        <input type='text' required name='nombreP' class='form-control' placeholder='Nombre' value='$fila2[1]'/><br>
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
        <input type='submit' name='$fila2[0]' value='Eliminar' class='btn btn-secondary'>
        </form></div><br><br>";

        echo $mostrar;

        $fila?$i = $fila[1]:'';
        
    }while($fila);
}

function eliminar($id, $conexion)
{
    $query = "DELETE FROM TipoPokemon WHERE ID_Pokemon = $id";
    $conexion->ejecutarQuery($query);

    $query = "DELETE FROM Pokemon WHERE ID = $id";
    $conexion->ejecutarQuery($query);
}

function modificar($conexion)
{
    $id = $_SESSION["id"];

    $t1v = $_SESSION["t1v"];
    $t2v = $_SESSION["t2v"];
    $nomv = $_SESSION["nombrev"];

    $nombre = $_SESSION["nombreP"];

    if($_SESSION["imagen"] != "")
    {
        $imgv = $_POST["imagenv"];
        $imagen = $_SESSION["imagen"];
        $path = pathinfo($imagen);
        $imgnombre = $path["filename"];
        $ext = $path["extension"];
        $tmp = $_SESSION["temp_nombre"];

        $dir = "../wwwroot/img/Pokemons/";

        $path_nombre_ext = $dir.$imgnombre.".".$ext;
    
        if(!file_exists($path_nombre_ext))
            move_uploaded_file($tmp, $path_nombre_ext);

        $query = "SELECT * FROM Pokemon WHERE Imagen LIKE '$imgnombre.$ext'";
        $resultado = $conexion->ejecutarQuery($query);

        if(!$conexion->getCantFilasAfectadas())
        {
            $query = "UPDATE Pokemon SET Imagen = '$imgnombre.$ext' WHERE Imagen LIKE '$imgv'";
            $resultado = $conexion->ejecutarQuery($query);
            unlink("../wwwroot/img/Pokemons/$imgv");
        }
        else
            echo "<div class='alert alert-danger ml-2 mr-2'>
            <strong>Error!</strong> Ya existe otro pokemon con la misma imagen
          </div>";

    }

    $tipo1 = $_SESSION["tipo1"];
    $tipo2 = $_SESSION["tipo2"];

    if($nombre != $nomv)
    {
        $query1 = "UPDATE Pokemon SET Nombre = '$nombre' WHERE ID = $id";
        $resultado1 = $conexion->ejecutarQuery($query1);
    }

    if($tipo1 != $t1v)
    {
        //id del tipo nuevo
        $query2 = "SELECT ID FROM Tipo WHERE Nombre LIKE '$tipo1'";
        $resultado2 = $conexion->ejecutarQuery($query2);
        $fila2 = $conexion->getFila($resultado2);
        $idtipo1 = $fila2[0];

        //id del tipo viejo
        $query2 = "SELECT ID FROM Tipo WHERE Nombre LIKE '$t1v'";
        $resultado2 = $conexion->ejecutarQuery($query2);
        $fila2 = $conexion->getFila($resultado2);
    
        $query3 = "UPDATE TipoPokemon SET ID_Tipo = $idtipo1 WHERE ID_Pokemon = $id AND
        ID_Tipo = $fila2[0]";
        $resultado3 = $conexion->ejecutarQuery($query3);
    }

    if(($tipo2 != "") && ($tipo1 != $tipo2))
    {
        //id del tipo nuevo
        $query2 = "SELECT ID FROM Tipo WHERE Nombre LIKE '$tipo2'";
        $resultado2 = $conexion->ejecutarQuery($query2);
        $fila2 = $conexion->getFila($resultado2);
        $idtipo2 = $fila2[0];

        //id del tipo viejo
        $query2 = "SELECT ID FROM Tipo WHERE Nombre LIKE '$t2v'";
        $resultado2 = $conexion->ejecutarQuery($query2);
        $fila2 = $conexion->getFila($resultado2);

        if(($tipo2 != $t2v) && ($t2v != ""))
        {
            $query3 = "UPDATE TipoPokemon SET ID_Tipo = $idtipo2 WHERE ID_Pokemon = $id AND ID_Tipo = $fila2[0]";
            $resultado3 = $conexion->ejecutarQuery($query3);
        }
        else
            if($t2v == "")
            {
                echo "hola tipo2 inserto";
                $query3 = "INSERT INTO TipoPokemon (ID_Tipo, ID_Pokemon) VALUES ($idtipo2, $id)";
                $resultado3 = $conexion->ejecutarQuery($query3);
            }
    }
    else
        if($t2v != "")
        {
            $query2 = "SELECT ID FROM Tipo WHERE Nombre LIKE '$t2v'";
            $resultado2 = $conexion->ejecutarQuery($query2);
            $fila2 = $conexion->getFila($resultado2);

            $query3 = "DELETE FROM TipoPokemon WHERE ID_Pokemon = $id AND ID_Tipo = $fila2[0]";
            $resultado3 = $conexion->ejecutarQuery($query3);
        }
}

function agregar($conexion)
{
    $nombre = $_SESSION["nombreP"];

    $imagen = $_SESSION["imagen"];
    $path = pathinfo($imagen);
    $imgnombre = $path["filename"];
    $ext = $path["extension"];
    $tmp = $_SESSION["temp_nombre"];

    $tipo1 = $_SESSION["tipo1"];
    $tipo2 = $_SESSION["tipo2"];

    $query = "SELECT * FROM Pokemon WHERE Nombre LIKE '$nombre' OR Imagen LIKE '$imgnombre.$ext'";
    $resultado = $conexion->ejecutarQuery($query);

    if(!$conexion->getCantFilasAfectadas())
    {
        $query = "INSERT INTO Pokemon (Nombre, Imagen) VALUES ('$nombre', '$imgnombre.$ext')";
        $resultado = $conexion->ejecutarQuery($query);
    
        $query = "SELECT ID FROM Pokemon WHERE Nombre LIKE '$nombre'";
        $resultado = $conexion->ejecutarQuery($query);
        $fila = $conexion->getFila($resultado);
    
        $query2 = "SELECT ID FROM Tipo WHERE Nombre LIKE '$tipo1'";
        $resultado2 = $conexion->ejecutarQuery($query2);
        $fila2 = $conexion->getFila($resultado2);
    
        $query3 = "INSERT INTO TipoPokemon (ID_Tipo, ID_Pokemon) VALUES ($fila2[0], $fila[0])";
        $resultado3 = $conexion->ejecutarQuery($query3);
       
        if($tipo2 != "")
        {
            $query2 = "SELECT ID FROM Tipo WHERE Nombre LIKE '$tipo2'";
            $resultado2 = $conexion->ejecutarQuery($query2);
            $fila2 = $conexion->getFila($resultado2);
    
            $query3 = "INSERT INTO TipoPokemon (ID_Tipo, ID_Pokemon) VALUES ($fila2[0], $fila[0])";
            $resultado3 = $conexion->ejecutarQuery($query3);
        }
        
        $dir = "../wwwroot/img/Pokemons/";
    
        $path_nombre_ext = $dir.$imgnombre.".".$ext;
    
        if(!file_exists($path_nombre_ext))
            move_uploaded_file($tmp, $path_nombre_ext);
    }
    else
        echo "<div class='alert alert-danger ml-2 mr-2'>
        <strong>Error!</strong> El pokemon ya existe o la imagen insertada ya pertenece a otro!
      </div>";
}

?>