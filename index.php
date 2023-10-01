<?php

session_start();
$result="";
$flag=false;

if(isset($_POST['btn']) && $_POST['btn'] == 'Registrar'){
    if(isset($_POST['cedula'])&&isset($_POST['nombre'])&&isset($_POST['matematica'])&&isset($_POST['fisica'])&&isset($_POST['programacion'])){
        if(is_numeric($_POST['cedula'])){
            if($_POST['cedula']>0&&ctype_digit($_POST['cedula'])){
                if(ctype_alpha($_POST['nombre'])){
                    if(is_numeric($_POST['matematica'])&&is_numeric($_POST['fisica'])&&is_numeric($_POST['programacion'])){
                        if($_POST['matematica']>1&&$_POST['fisica']>1&&$_POST['programacion']>1){
                            if($_POST['matematica']<=20&&$_POST['fisica']<=20&&$_POST['programacion']<=20){

                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    $alumno = [
                                        'cedula' => $_POST['cedula'],
                                        'nombre' => $_POST['nombre'],
                                        'matematica' => $_POST['matematica'],
                                        'fisica' => $_POST['fisica'],
                                        'programacion' => $_POST['programacion'],
        
                                    ];
                                
                                    $_SESSION['alumno'][] = $alumno; 
                                    $result='<div class="box margen" style="background-color: #61a6ab"><p style="color: green; padding-top:1%">&nbsp;&nbsp;Datos ingresados exitosamenete.</p><div>';
                                    $flag=true;
                                }
                            }else{
                                $result='<div class="box margen" style="background-color: #61a6ab"><p style="color: red; padding-top:1%">&nbsp;&nbsp;Nota no válida. Los valores deben ser menor o igual a 20.</p></div>';
                                $flag=true;
                            }
                        }else{
                            $result='<div class="box margen" style="background-color: #61a6ab"><p style="color: red; padding-top:1%">&nbsp;&nbsp;Nota no válida. Los valores deben ser superior a 1.</p></div>';
                            $flag=true;
                        }
                    }else{
                        $result='<div class="box margen" style="background-color: #61a6ab"><p style="color: red; padding-top:1%">&nbsp;&nbsp;Los campos de notas deben ser datos numéricos.</p></div>';
                        $flag=true;
                    }
                }else{
                    $result='<div class="box margen" style="background-color: #61a6ab"><p style="color: red; padding-top:1%">&nbsp;&nbsp;El campo nombre debe ser un dato alfabético.</p></div>';
                    $flag=true;
                }
            }else{
                $result='<div class="box margen" style="background-color: #61a6ab"><p style="color: red; padding-top:1%">&nbsp;&nbsp;Cédula no válida.</p></div>';
                $flag=true;
            }
        }else{
            $result='<div class="box margen" style="background-color: #61a6ab"><p style="color: red; padding-top:1%">&nbsp;&nbsp;El campo cédula debe ser un dato numérico.</p></div>';
            $flag=true;
        }
    }else{
        $result='<div class="box margen" style="background-color: #61a6ab"><p style="color: red; padding-top:1%">&nbsp;&nbsp;No se enviaron los datos.</p></div>';
        $flag=true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica PHP 2</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container margen">
        <div class="box">
            <div class="box margen" style="background-color: #61a6ab">
                <div class="row">
                    <h1 class="display-5 text-center">Registrar Alumno</h1>
                </div>
                <div class="margen">
                    <form action="" method="post">
                    <div class="row">
                        <div class="col-md-2 col-sm-12"></div>
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-1">
                                <label for="cedula">Cédula:</label>
                                <input type="text" name="cedula" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" required>
                            </div>
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-1 col-sm-12"></div>
                        <div class="col-md-3 col-sm-12">
                            <div class="mb-3">
                                <label for="matematica">Nota en matemáticas:</label>
                                <input type="text" name="matematica" required>
                            </div><br>
                        </div>

                        <div class="col-md-3 col-sm-12"> 
                            <div class="mb-3  ">
                                <label for="fisica">Nota en física:</label>
                                <input type="text" name="fisica" required>
                            </div><br>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="mb-3">
                                <label for="programacion">Nota en programación:</label>
                                <input type="text" name="programacion" required>
                            </div><br>
                        </div>
                    </div>
                    <br>
                    <div class="row boton">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-2 col-sm-12 boton">
                            <input type="submit" value="Registrar" name="btn">
                        </div>
                        <div class="col-md-2 col-sm-12">
                        </div>
                        <br>
                        <div class="col-md-3 col-sm-12 boton">
                            <div class="margen-boton">
                                <a href="consultar.php">Consultar alumnos</a>
                            </div>
                        </div>
                    </div>
                    
                    </form>

                </div>
            </div>

            <?php
                if($flag==true){
                    echo $result;
                }
            ?>
        </div>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>