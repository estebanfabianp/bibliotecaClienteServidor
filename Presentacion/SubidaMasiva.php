<?php
/**
 * Long Desc 
 * */
/**
 * Capa de presentación de subida masiva donde  los usuarios de tipo admninistrador puede subir
 * registro de informacion de manera masiva para que sea mas eficiente el ingreso de informacíon.
 * 
 * @category Educativo
 * @author Esteban fabian patiño montealegre <estebanfabianp@gmail.com>
 * @link https://github.com/estebanfabian/bibliotecaClienteServidor.git 
 * @version Revision: 1.0 
 * */
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../assets/img/img/recurso/escudo1.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>BiblioCur</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
        <link rel="stylesheet" href="../assets/css/styles.min.css?h=313b471bd9c649213fb455372265f1e2">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/script.min.js?h=fedf14a447758dc0b3c6f999b9fc334b"></script>
<!--        <script src="../assets/js/localization/messages_es.js" type="text/javascript"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.js"></script>     
    </head> 
    <body>.bg{background-color:red}<!-- Navigation -->
        <div id = cabecera>
            <input type="hidden" size="15" maxlength="30" value="<?php echo $_SESSION["usuario"]["codigo"]; ?>" name="nombre" id="codigo">
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#A2121C;margin-left: 5px;margin-right: 5px;">
                <div class="container">
                    <a class="navbar-brand" href="#">BibloCur</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <?php if ($_SESSION) { ?>
                                    <div class="col-4">
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php echo $_SESSION["usuario"]["nombre"]; ?>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background-color:#A2121C;">
                                                <a class="dropdown-item menu" id="btnmultas">Multa</a> 
                                                <a class="dropdown-item menu" href="view/CambiarClave.php">Cambiar Contraseña</a>
                                                <a class="dropdown-item menu" href="cerrarSesion.php">Cerrar Sesión</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Iniciar sesión</button>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!--login-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img src="../assets/img/img/recurso/escudo.png?h=eee25ba9f90f85fbd39b9f9cc373043d" class="logo_urep"> <h5 class="modal-title" id="exampleModalLabel"> Iniciar sesión</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Begin # DIV Form -->
                            <div id="div-forms">
                                <!-- Begin # Login Form -->
                                <form id="login-form" name ="login-form" >
                                    <div class="modal-body">
                                        Código
                                        <input id="login_username" name ="codigo" class="form-control" type="text" placeholder="Código" >
                                        <br>				
                                        Clave
                                        <input id="login_password" name ="contrasena" class="form-control" type="password" placeholder="Clave" >
                                        <br> <div class="checkbox">
                                            <label>
                                                <input type="checkbox">Recuerdame
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div >
                                            <button id="BTNIngresar" type="submit" class="btn btn-secondary" style = "width:100%">Ingresar</button>
                                            <button id="login_lost_btn" type="reset" class="btn btn-secondary" style = "width:100%">¿Olvidó su contraseña?</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- End # Login Form -->
                                <!-- Begin | Lost Password Form -->
                                <form id="lost-form" style="display:none;">
                                    <div class="modal-body">
                                        Código
                                        <input id="lost_codigo" class="form-control" type="text" placeholder="Código" required>
                                        Correo
                                        <input id="lost_email" class="form-control" type="text" placeholder="Correo" required>
                                    </div>
                                    <div class="modal-footer">
                                        <div>
                                            <button type="submit" class="btn btn-secondary" >Recordar clave</button>
                                        </div>
                                        <div>
                                            <button id="lost_login_btn" type="button" class="btn btn-secondary" >Iniciar sesión</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- End | Lost Password Form -->
                            </div>
                            <!-- End # DIV Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!--fin de login-->
            <!-- Modal -->
            <div class="modal fade" id="alerta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="alertaMensaje">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id = "alertaCuerpo"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header -->
            <header class="bg pt-5 mb-5" style="margin-left: 5px;margin-right: 5px;">
                <script src="../assets/js/logica.js" type="text/javascript"></script>
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-lg-12"> 								
                            <!-- LOGO - DESCRIPCION -->
                            <div class="col s4 m2 l2 right-align menu_nav">
                                <a href=""> <img src="../assets/img/img/recurso/escudo.png?h=eee25ba9f90f85fbd39b9f9cc373043d" class="logo_urep"> </a>
                            </div>
                            <div class="col s6 m9 l4 left-align menu_nav">
                                <div style="display:inline-block;">
                                    <h1 class="tipo_urep" style="width: 100%; " >Corporación Universitaria Republicana</h1>
                                </div>
                            </div>
                            <!-- FIN - LOGO DESCRIPCION -->
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #0B675D;">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Quiénes somos 
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="view/misionYvision.php">Misión y Visión</a>
                                        <a class="dropdown-item" href="AcercaBiblioCur.php">Acerca de BilioCur</a>
                                        <a class="dropdown-item" href="OtroServicios.php">Otros Servicios</a>
                                        <a class="dropdown-item" href="http://urepublicana.edu.co/">Corporacion Universitaria Republicana</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Reserva
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="view/PrestamoLibro.php">Libro</a>
                                        <a class="dropdown-item" href="view/videoBeam.php">Video Beam</a>
                                        <a class="dropdown-item" href="view/videoBeam.php"></a>
                                    </div>
                                </li>
                                <?php if ($_SESSION) { ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Prestamo
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="view/PrestamoLibro.php">Libro</a>
                                            <a class="dropdown-item" href="view/videoBeam.php">Video Beam</a>
                                            <a class="dropdown-item" href="#">Prestamo Interbibliotecario</a>
                                        </div>
                                    </li>
                                    <?php if ($_SESSION["usuario"]["perfil"] == "administrador") { ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Gestion
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="view/registrarUsuario.php">Usuario</a>
                                                <a class="dropdown-item" href="view/RegistrarLibro.php">Empleados</a>
                                                <a class="dropdown-item" href="registrarVideoBeam.php">Video Beam</a>
                                                <a class="dropdown-item" href="view/RegistrarLibro.php">Material audiovisual</a>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="view/noticias.php">Noticias</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="view/Contactanos.php">Contactanos</a>
                                </li>
                            </ul>
                            <form class="form-inline my-2 my-lg-0">
                                <select name="Filtro" class="form-control" id="filtro">
                                    <option value="" disabled selected>Buscar por:</option>
                                    <option value="Isbn">Isbn</option>
                                    <option value="Autor">Autor</option>
                                    <option value="Titulo">Titulo</option>
                                    <option value="Editorial">Editorial</option>
                                    <option value="Tema">Tema</option>
                                </select>
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </header>
        </div>
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <form id="subida">
                        <h2>Subida masiva</h2>
                        <P>Selecione el tipo de formato que  desea subir para realizar el ingreso de la información.</P>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Selecione el tipo de Archivo</label>
                                <select name="tipoFormato" class="form-control" id="tipoFormato">
                                    <option value="" disabled selected>Tipo de formato</option>
                                    <option value="SbMasivaVideoBeam">Video Beam</option>
                                    <option value="SbMasivaComputador">Computador</option>
                                    <option value="SbMasivaUsuario">Usuario</option>
                                    <option value="SbMasivaLibro">Libro</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlFile1">Archivo de subida</label>
                                <input type="file"  id="csv" name="csv" />
                                Subir imagen: <input type="file" id="SbImagen" name="file[]" multiple>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary"  value="Cargar" id="Cargar"/>                       
                    </form>
                </div>
                <div class="col-md-3">
                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                        <button type="button" id="btnCatalogoLinea" class="btn btn-secondary">Catalogo en línea</button>
                        <button type="button" class="btn btn-secondary">Préstamos, consulta y renovación </button>
                        <button type="button" class="btn btn-secondary">Sugerir títulos </button>
                        <?php if ($_SESSION) { ?>
                            <button type="button" id="CerrarSesion" class="btn btn-secondary" data-toggle="modal" data-target="#login-modal"> Cerrar sesión </button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat"> Iniciar sesión </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
        <!-- Footer -->
        <footer id="piePagina" class="py-1">
        </footer>
        <script>
            $(document).ready(function () {
                $("#Cargar").click(function () {
                    $("#subida").validate({
                        rules: {
                            csv: {
                                required: false,
                                extension: "csv"
                            }, tipoFormato: {
                                required: true
                            }
                        }, submitHandler: function () {
                            var filtro = $("#tipoFormato").val();
                            switch (filtro) {
                                case "SbMasivaVideoBeam":
                                    subida(filtro);
                                    break;
                                case "SbMasivaComputador":
                                    subida(filtro);
                                    break;
                                case "SbMasivaUsuario":
                                    subida(filtro);
                                    break;
                                case "SbMasivaLibro":
                                    subida(filtro);
                                    break;
                                default:
                                    alert("Error");
                                    break;
                            }
                        }
                    });
                });
                function subida($url) {
                    var comprobar = $('#csv').val().length;
                    if (comprobar > 0) {
                        var formulario = $('#subida');
                        var archivos = new FormData();
                        var url = $url;
                        for (var i = 0; i < (formulario.find('input[type=file]').length); i++) {
                            archivos.append((formulario.find('input[type="file"]:eq(' + i + ')').attr("name")), ((formulario.find('input[type="file"]:eq(' + i + ')')[0]).files[0]));
                        }
                        $.ajax({
                            url: url,
                            type: 'POST',
                            contentType: false,
                            data: archivos,
                            processData: false,
                            success: function (data) {
                                alert(data);
                                console.log(data);
                            }
                        });
                        return false;
                    } else {
                        alert('Selecciona un archivo CSV para importar');
                        return false;
                    }
                }
            }
            );
        </script>

    </body>
</html>





