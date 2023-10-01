<?php
session_start();

// Aprobaron cada materia
function aprobMat($alumno) {
    return $alumno['matematica'] >=9.5;
}

function aprobFis($alumno) {
    return $alumno['fisica'] >=9.5;
}

function aprobProg($alumno) {
    return $alumno['programacion'] >=9.5;
}

// Aproblazaron cada materia
function aplazMat($alumno) {
    return $alumno['matematica'] <9.5;
}

function aplazFis($alumno) {
    return $alumno['fisica'] <9.5;
}

function aplazProg($alumno) {
    return $alumno['programacion'] <9.5;
}

// Alumno aprobo todas las materias
function aprobTodaMateria($alumno) {
    return $alumno['matematica'] >=9.5 && $alumno['fisica'] >=9.5 && $alumno['programacion'] >=9.5;
}

// Alumno aprobo dos materias
function aprobDosMateria($alumno) {
    return ($alumno['matematica'] >=9.5 && $alumno['fisica'] >=9.5 && $alumno['programacion'] <9.5)||($alumno['matematica'] >=9.5 && $alumno['fisica'] <9.5 && $alumno['programacion'] >=9.5)||($alumno['matematica'] <9.5 && $alumno['fisica'] >=9.5 && $alumno['programacion'] >=9.5);
}

// Alumno aprobo una materias
function aprobUnaMateria($alumno) {
    return ($alumno['matematica'] >=9.5 && $alumno['fisica'] <9.5 && $alumno['programacion'] <9.5)||($alumno['matematica'] <9.5 && $alumno['fisica'] >=9.5 && $alumno['programacion'] <9.5)||($alumno['matematica'] <9.5 && $alumno['fisica'] <9.5 && $alumno['programacion'] >=9.5);
}


//Promedio de cada materia
function calculaPromedioMat($alumno, $materia) {
    $total=0;
    foreach($alumno as $alu){
        $total+=$alu[$materia];
    }
    return $total;
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
    <div class="margen">
        <div class="box">
            <div class="box margen" style="background-color: #61a6ab">
            <div class="row"><h1 class="display-5 text-center">Consultar alumnos</h1></div>

            <?php
                if (isset($_SESSION['alumno'])) {

                    $alumno = $_SESSION['alumno'];

                    // contador 
                    $i=1; 

                    // Alumnos aprobados por materia
                    $numAproMat = count(array_filter($alumno, 'aprobMat'));
                    $numAproFis = count(array_filter($alumno, 'aprobFis'));
                    $numAproProg = count(array_filter($alumno, 'aprobProg'));

                    // Alumnos aplazados por materia
                    $numAplaMat = count(array_filter($alumno, 'aplazMat'));
                    $numAplaFis = count(array_filter($alumno, 'aplazFis'));
                    $numAplaProg = count(array_filter($alumno, 'aplazProg'));

                    // Alumnos que aprobaron todas las materia
                    $numAprobTodas = count(array_filter($alumno, 'aprobTodaMateria'));
                    
                    // Alumnos que aprobaron dos materias
                    $numAprobDos = count(array_filter($alumno, 'aprobDosMateria'));

                    // Alumnos que aprobaron una materia
                    $numAprobUna= count(array_filter($alumno, 'aprobUnaMateria'));

                        // Nota maxima de las materias
                    $notaMaxMat=0;
                    foreach($alumno as $alu){
                        if($alu['matematica']>$notaMaxMat){
                            $notaMaxMat= $alu['matematica'];
                        }
                    }

                    $notaMaxFis=0;
                    foreach($alumno as $alu){
                        if($alu['fisica']>$notaMaxFis){
                            $notaMaxFis= $alu['fisica'];
                        }
                    }

                    $notaMaxProg=0;
                    foreach($alumno as $alu){
                        if($alu['programacion']>$notaMaxProg){
                            $notaMaxProg= $alu['programacion'];
                        }
                    }

                    // Promedio de notas en casa materia
                    $sumNotaMat = calculaPromedioMat($alumno, 'matematica');
                    $sumNotaFis = calculaPromedioMat($alumno, 'fisica');
                    $sumNotaProg = calculaPromedioMat($alumno, 'programacion');

                    
                    // *** Diseño de la pagina ***
                    echo    '<div class="margen-tabla">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Cedula</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Nota en Matematica</th>
                                            <th scope="col">Nota en Física</th>
                                            <th scope="col">Nota en Programación</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">';
                    foreach($alumno as $fila){  
                        echo    '<tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$fila["cedula"].'</td>
                                            <td>'.$fila["nombre"].'</td>
                                            <td>'.$fila["matematica"].'</td>
                                            <td>'.$fila["fisica"].'</td>
                                            <td>'.$fila["programacion"].'</td>
                                        </tr>';
                        $i++;
                    }
                                
                    echo            '</tbody>
                                </table>
                            </div>
                            <div class="centar-botones">
                                <p class="d-inline-flex gap-1">
                                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1">Promedio de notas</button>
                                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Alumnos aprobados</button>
                                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" aria-expanded="false" aria-controls="multiCollapseExample3">Alumnos aplazados</button>
                                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample4" aria-expanded="false" aria-controls="multiCollapseExample4">Resumen</button>
                                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample5" aria-expanded="false" aria-controls="multiCollapseExample5">Máxima nota</button>
                                </p>
                                <div class="row margen-resultados">
                                    <div class="col col-sm-12">
                                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                                            <div class="card ">
                                                <br>
                                                <p class="negrilla">Promedio de notas en cada materia</p>
                                                    <p>Matemática: '.number_format($sumNotaMat/($numAproMat+$numAplaMat), 2, '.', '').'</p>
                                                    <p>Física: '.number_format($sumNotaFis/($numAproFis+$numAplaFis), 2, '.', '').'</p>
                                                    <p>Programación: '.number_format($sumNotaProg/($numAproProg+$numAplaProg), 2, '.', '').'</p>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                                            <div class="card">
                                                <br>
                                                <p class="negrilla">Numero de alumnos aprobados por materia</p>
                                                    <p>Matemática: '.$numAproMat.'</p>
                                                    <p>Física: '.$numAproFis.'</p>
                                                    <p>Programación: '.$numAproProg.'</p><br>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="collapse multi-collapse" id="multiCollapseExample3">
                                            <div class="card">
                                                <br>
                                                <p class="negrilla">Numero de alumnos aplazados por materia</p>
                                                    <p>Matemática: '.$numAplaMat.'</p>
                                                    <p>Física: '.$numAplaFis.'</p>
                                                    <p>Programación: '.$numAplaProg.'</p>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="collapse multi-collapse" id="multiCollapseExample4">
                                            <div class="card">
                                                <br>
                                                <p class="negrilla">Alumnos que aprobaron</p>
                                                    <p>Todas Materia: '.$numAprobTodas.'</p>
                                                    <p>Dos Materia: '.$numAprobDos.'</p>
                                                    <p>Una Materia: '.$numAprobUna.'</p>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="collapse multi-collapse" id="multiCollapseExample5">
                                            <div class="card">
                                                <br>
                                                <p class="negrilla">Nota máxima en cada materia</p>
                                                    <p>Matemática: '.$notaMaxMat.'</p>
                                                    <p>Física: '.$notaMaxFis.'</p>
                                                    <p>Programación: '.$notaMaxProg.'</p>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>

                            </div>';

                }else {
                    echo '<p class="negrilla">&nbsp;&nbsp;&nbsp;&nbsp;No hay alumnos registrados en el sistema</p>';
                }
            ?>

            <br>
            <div class="row ">
                <div class="col-md-3 col-sm-12 boton"></div>
                <div class="col-md-2 col-sm-12 boton">
                    <div class="margen-boton">
                        <a href="index.php">Regresar</a>
                    </div>
                </div>

            <div class="col-md-1 col-sm-12"><br></div>
                <div class="col-md-3 col-sm-12 boton">
                    <div class="margen-boton">
                        <a href="borrarRegistro.php">Eliminar registro</a>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
</body>
</html>