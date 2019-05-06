<?php

abstract class Constantes
{
    //Input
    const INPUTNOMBRE = "inputNombre";
    const INPUTAPELLIDO = "inputApellido";
    const INPUTNICKNAME = "inputNickname";
    const INPUTEMAILORNICK = "inputEmailOrNick";
    const INPUTPASSWORD = "inputPassword";
    const INPUTREPASSWORD = "inputRePassword";
    const INPUTEMAIL = "inputEmail";
    const INPUTFECHANACIMIENTO = "inputFechaNacimiento";
    const INPUTPROVINCIA = "inputProvincia";
    const INPUTLOCALIDAD = "inputLocalidad";
    const INPUTCALLE = "inputCalle";
    const INPUTALTURA = "inputAltura";
    const INPUTDEPTO = "inputDepto";
    const INPUTPISO = "inputPiso";

    //Botones
    const BTNINGRESAR = "btnIngresar";
    const BTNREGISTRAR = "btnRegistrar";

    //Regex
    const REGEXLETRASYNUMEROS = "/^[0-9a-zA-Z]+$/";
    const REGEXEMAIL = "/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/";
    const REGEXSOLOLETRAS = "/^[a-zA-Z]+$/";
    const REGEXLETRASYESPACIO = "/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/";
    const REGEXSOLONUMEROS = "/^[0-9]+$/";

    //Páginas
    const REGISTRARPAGE = "registrar.php";

    //Otros
    const FROMPAGE = "fromPage";
}


?>