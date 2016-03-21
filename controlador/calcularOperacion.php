<?php

require '../vendor/autoload.php';

use calculadoraTDD4\modelo\OperadorBinario;
use calculadoraTDD4\validacion\ValidadorLimiteSuperior;
use calculadoraTDD4\validacion\ValidadorLimiteInferior;
use calculadoraTDD4\validacion\ValidadorOperacion;
use calculadoraTDD4\vista\FormateadorResultado;

$operando1 = filter_input(INPUT_GET,'operando1', FILTER_VALIDATE_INT);
$operando2 = filter_input(INPUT_GET,'operando2', FILTER_VALIDATE_INT);
$operacion = filter_input(INPUT_GET,'operacion', FILTER_SANITIZE_STRING);
$limiteInferior = filter_input(INPUT_GET,'limite_inferior',FILTER_VALIDATE_INT);
$limiteSuperior = filter_input(INPUT_GET,'limite_superior', FILTER_VALIDATE_INT);

$descripcionOperacion="";
if (($operando1 != false) && ($operando2 != false) && ($limiteSuperior != false) && ($limiteInferior != false)){
    
    $operador = new OperadorBinario();
    
    $operadorLimSup = new ValidadorLimiteSuperior($operador);
    $operadorLimSup->setCriterio($limiteSuperior);
    
    $operadorLimSupInf = new ValidadorLimiteInferior($operadorLimSup);
    $operadorLimSupInf->setCriterio($limiteInferior);
    
    $operadorLimSupInfCheckOp = new ValidadorOperacion($operadorLimSupInf);
    

    try {
        $resultado = $operadorLimSupInfCheckOp->operacion($operando1, $operando2, $operacion);
        $formateadorResultado = new FormateadorResultado();
        $descripcionOperacion = $formateadorResultado->mostrar($operando1, $operando2, $operacion, $resultado);
        
    } catch (\Exception $ex){
        $descripcionOperacion = $ex->getMessage();
    }   
} else {
    $descripcionOperacion = "No es posible calcular la operación";
}
    
 require '../vista/plantillaOperacion.php';



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

