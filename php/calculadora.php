<?php

$pantalla = "";
$resultado = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_POST['btn']) {
        case 'limpiar':
            $pantalla = "";
            $resultado = "";
            break;
        case 'CE':
            $pantalla = isset($_POST['pantalla']) ? $_POST['pantalla'] : "";
            $pantalla = substr($pantalla, 0, -1);
            break;
        case '=':
            $pantalla = isset($_POST['pantalla']) ? $_POST['pantalla'] : "";
            try {
                $resultado = eval('return ' . str_replace('%', '/100*', $pantalla) . ';');
                if ($resultado === false){
                    throw new Exception("Error en calculo");
                }
            } catch (Throwable $e){
                $error = "Error de sintaxis";
                $resultado = "ERROR";
            }
            break;
        default:
            $pantalla = isset($_POST['pantalla']) ? $_POST['pantalla'] : "";
            $pantalla .= $_POST['btn'];
            break;
}}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calculadora PHP</title>    
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="info-container container">
            <h1>Calculadora PHP</h1>
            <p>Tarea Semana 1 -  Semestre 6</p>
            <p>Materia: Aplicaciones Web</p>
        </div>
        <div class="botones-acciones container">
            <form method="post">
                <button name="btn" value="limpiar">Limpiar</button>
                <button><a href="../html/index.html"> Volver a página personal</a></button>
            </form>
        </div>
        <div class="calculadora container">
            <form method="post">
                <input type="hidden" name="pantalla" value="<?= htmlspecialchars($pantalla) ?>">
                <div class="pantalla">
                    <div class="expresion"><?= htmlspecialchars($pantalla) ?></div>
                    <div class="resultado"><?= htmlspecialchars($resultado) ?></div>
                    <div class="error"><?= htmlspecialchars($error) ?></div>
                </div>
                <table>
                    <tr>
                    <td><button name="btn" value="(">(</button></td>
                    <td><button name="btn" value=")">)</button></td>
                    <td><button name="btn" value="%">%</button></td>
                    <td><button name="btn" value="CE">CE</button></td>
                </tr>
                <tr>
                    <td><button name="btn" value="7">7</button></td>
                    <td><button name="btn" value="8">8</button></td>
                    <td><button name="btn" value="9">9</button></td>
                    <td><button name="btn" value="/">÷</button></td>
                </tr>
                <tr>
                    <td><button name="btn" value="4">4</button></td>
                    <td><button name="btn" value="5">5</button></td>
                    <td><button name="btn" value="6">6</button></td>
                    <td><button name="btn" value="*">×</button></td>
                </tr>
                <tr>
                    <td><button name="btn" value="1">1</button></td>
                    <td><button name="btn" value="2">2</button></td>
                    <td><button name="btn" value="3">3</button></td>
                    <td><button name="btn" value="-">−</button></td>
                </tr>
                <tr>
                    <td><button name="btn" value=".">.</button></td>
                    <td><button name="btn" value="0">0</button></td>
                    <td><button name="btn" value="=">=</button></td>
                    <td><button name="btn" value="+">+</button></td>
                </tr>
                </table>
            </form>   
        </div>
    </body>
</html>