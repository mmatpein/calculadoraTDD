<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="get" action="controlador/calcularOperacion.php">
            <label for="operando1">Operando1:</label><input type="number" id="operando1" name="operando1" value="0"/><br/>
            <label for="operando2">Operando2:</label><input type="number" id="operando2" name="operando2" value="0"/><br/>
            <label for="radio_sumar">Sumar</label><input type="radio" id="radio_sumar" name="operacion" value="suma"/><br/>
            <label for="radio_restar">Restar</label><input type="radio" id="radio_restar" name="operacion" value="resta"/><br/>
            <label for="radio_multiplicar">Mutliplicar</label><input type="radio" id="radio_multiplicar" name="operacion" value="multiplicacion"/><br/>
            <label for="radio_dividir">Dividir</label><input type="radio" id="radio_dividir" name="operacion" value="division"/><br/>
            <label for="limite_superior">Limite inferior</label><input type="number" id="limite_inferior" name="limite_inferior"/><br/>
            <label for="limite_inferior">Limite superior</label><input type="number" id="limite_superior" name="limite_superior"/><br/>
            <input type="submit" id="submit_operacion" value="Calcular"/>
        </form>
    </body>
</html>
