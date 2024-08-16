<?php
session_start();
ob_start();
include("../Usuarios.php");
ob_end_flush();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['estado']['msg'])){
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}

if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){

    $user = new User();
    $conditions['where'] = array(
        'id' => $sessData['userID'],

    );
    $conditions['return_type'] = 'single';
    $userData = $user->getRows($conditions);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Agencia de Innovacion</title>
<link rel="stylesheet" href="style.css" type="text/css" media="all" />
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900"  type="text/css" media="all">
<!-- Último minificado bootstrap css -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery libraria incluida -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!-- Último minificado bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- cerrar sesion automaticamente -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>





<style>
.btn-success {
  margin: 10px;
}
.main {
  margin: 20px;
}

body{
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

.hide {
    max-height: 0 !important;
}

.dropdown{
  border: 0.1em solid black;
  width: 10em;
  margin-bottom: 1em;
}

.dropdown .title{
  margin: .3em .3em .3em .3em;  
  width: 100%;
}

.dropdown .title .fa-angle-right{
  float: right;
  margin-right: .7em;
  transition: transform .3s;
}

.dropdown .menu{
  transition: max-height .5s ease-out;
  max-height: 20em;
  overflow: hidden;
}

.dropdown .menu .option{
  margin: .3em .3em .3em .3em;
  margin-top: 0.3em;
}

.dropdown .menu .option:hover{
  background: rgba(0,0,0,0.2);
}

.pointerCursor:hover{
  cursor: pointer;
}

.rotate-90{
  transform: rotate(90deg);
}


* {
    margin: 0;
    padding: 0;
    border: o none;
    position: relative;
}
#menu_gral {
    font-family: verdana, sans sherif;
    width: 80%;
    margin: 1.5rem auto;
}
#menu_gral ul {
    list-style-type: none; 
    text-align: center;
    font-size: 0;
}
#menu_gral > ul li {
    display: inline-block;
    width: 25%;
    position: relative;
    background: #337ab7;
}
#menu_gral li a {
    display: block;
    text-decoration: none;
    font-size: 2rem;
    font-family: 'Roboto', sans-serif;
    background-color: #2698f3;
    font-size: 18px;
    line-height: 2.5rem;
    color: #fff;
}
#menu_gral li:hover a, #menu_gral li a:focus {
    background: #e55916;
    color: #fff;
}

#menu_gral li ul {
    position: absolute;
    width: 0;
    overflow: hidden;
}
#menu_gral li:hover ul, #menu_gral li:focus ul {
    width: 100%;
    margin: 0 -4rem -4rem -4rem;
    padding: 0 4rem 4rem 4rem;
   
    z-index: 5;
}
#menu_gral li li {
    display: block;
    width: 130%;
}
#menu_gral li:hover li a, #menu_gral li:focus li a {
    font-family: monospace;
    font-size: .9rem;
    line-height: 1.7rem;
    border-top: 1px solid #e5e5e5;
    background: #e55916;
}
#menu_gral li li a:hover, #menu_gral li li a:focus {
    background: #8AA9B8; 
}

#preload-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #fff;
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
}

.loader {
  border: 16px solid #f3f3f3;
  border-top: 16px solid #3498db;
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}



</style>
<!--<link rel="icon" type="image/png" href="./imagenes/escudo-32x32.png">-->

<link rel="shortcut icon" href="../../imagenes/favicon.svg" type="image/x-icon"/>  


</head>

<!--<center><img src="../../imagenes/fondoCabecera.jpg"></center>-->
<center><img src="../../imagenes/aif-logo.png" width="400" height="100"></center>

<body>

  





  <script type="text/javascript">
    window.addEventListener('load', function() {
  var preloadOverlay = document.getElementById('preload-overlay');
  preloadOverlay.style.display = 'none';
});



var base_url = '../../MiCuenta.php?logoutSubmit=1'; // Ruta base del sitio
var tiempoInactividad = 3000; // Tiempo en milisegundos para detectar inactividad (3 segundos por defecto)
//var tiempoInactividad = 300000; // 5 minutos en milisegundos (300000 ms)
var timeoutInactividad; // Variable para almacenar el timeout


// Función para iniciar el contador de inactividad
function iniciarContadorInactividad() {
  // Reiniciar el timeout anterior
  clearTimeout(timeoutInactividad);

  // Iniciar un nuevo timeout
  timeoutInactividad = setTimeout(function() {
    mostrarAlertaInactividad();
  }, tiempoInactividad);
}

// Función para mostrar la alerta de inactividad
function mostrarAlertaInactividad() {
  $.confirm({
    title: 'Alerta de Inactividad!',
    content: 'La sesión está a punto de expirar.',
    autoClose: 'expirar|10000', // Cerrar la ventana automáticamente después de 10 segundos
    type: 'red',
    icon: 'fa fa-spinner fa-spin',
    buttons: {
      expirar: {
        text: 'Cerrar Sesión',
        btnClass: 'btn-red',
        action: function() {
          salir();
        }
      },
      permanecer: {
        text: 'Seguir Activo',
        btnClass: 'btn-blue',
        action: function() {
          iniciarContadorInactividad(); // Reiniciar el contador
          $.alert('La sesión ha sido reiniciada.'); // Mensaje de confirmación
        }
      }
    }
  });
}

// Función para cerrar la sesión y redireccionar a la página principal
function salir() {
  window.location.href = base_url;
}

// Eventos para detectar actividad del usuario
document.onmousemove = function() {
  iniciarContadorInactividad();
}; // Detectar movimiento del mouse
document.onkeypress = function() {
  iniciarContadorInactividad();
}; // Detectar pulsación de tecla
document.onclick = function() {
  iniciarContadorInactividad();
}; // Detectar clic en la página

// Iniciar el contador de inactividad al cargar la página
iniciarContadorInactividad();


  </script>



<div class="main" >
<div class="panel panel-default">

<div class="panel-heading">
  <ul class="nav nav-pills">
   
    <li role="group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

      </div>
  </li>

  <nav id="menu_gral">
  <ul>
    <li>
     <div class="card-body d-flex justify-content-between align-items-center">
      <a href="../panel2.php"  class="btn btn-primary">Inicio</a>

      
      </div>
    </li>
    <li>
      <div class="card-body d-flex justify-content-between align-items-center">
      <a href="#" class="btn btn-primary">Legajos</a></div>
        <ul>
          <li><a href="../ListadoDeDocentes/ListarListadosDeDocentes.php"><font size="4">Listado de Docentes</font></b></a></li>
          <li><a href="../Docentes/ListarDocentes.php"><font size="4">Editar Docentes</font></b></a></li>
          <li><a href="../../controller/exportar_docentes_especiales.php"><font size="3">Listado Docentes de Especial(Temporal)</font></a></li>
          <li><a href="../..//controller/exportar_docentes_especiales_SinTitulares.php"><font size="3">Listado Docentes de Especial SIN TITULARES(Temporal)</font></a></li>
           <li><a href="../../controller/exportar_docentes_especiales_completos.php"><font size="3">Listado Docentes de Esp.(Interino,supl.y Titulares)</font></a></li>
        </ul>
    </li>
         <li>
          <div class="card-body d-flex justify-content-between align-items-center">
          <a href="#"  class="btn btn-primary">Administracion</a></div>
        <ul>
          <li><a href=../Modalidades/ListarModalidades.php><font size="4">Modalidades</font></a></li>
          <li><a href="../Dependencias/ListarDependencias.php"><font size="4">Dependencia</font></a></li>
          <li><a href="../ConfiguracionListados/ListarConfiguracionListados.php"><font size="3">Configuracion Listados</font></a></li>
        </ul>
    </li>
      <?php echo(($userData['rol']=='admin') ? ('<li>
       <div class="card-body d-flex justify-content-between align-items-center">
       <a href="Usuarios/ListarUsuarios.php" class="btn btn-primary" class="logout">Usuarios</a>
       </div>
    </li>') : ''); ob_end_flush(); ?>
  </ul>

</nav>


<!--
<li>

  <div class="card-body d-flex justify-content-between align-items-center">
  <a href="Registro.php" class="btn btn-primary" class="logout">Usuarios</a>
</div>

</li> -->
<!-- 
<li>
  <div class="card-body d-flex justify-content-between align-items-center">
  <a href="../MiCuenta.php?logoutSubmit=1"   class="btn btn-primary" class="logout">Cerrar Sesion</a>
</div>

</li> 
-->
  </ul>


</div>

</body>
