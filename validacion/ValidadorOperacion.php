<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace calculadoraTDD4\validacion;

/**
 * Description of OperadorBinario
 *
 * @author mauri
 */
//require '../vendor/autoload.php';
use calculadoraTDD4\modelo\Operador;

class ValidadorOperacion extends Validador{
    
    function __construct($operador){
        parent::__construct($operador);
    }
    
    public function operacion($operando1, $operando2, $operacion) {
        $operacionValidada = $this->validar($operacion);
        $resultado = $this->operador->operacion($operando1, $operando2, $operacionValidada);
        return $resultado;
    }

    public function setCriterio($criterio){
        $this->criterio = $criterio;
    }
    
    protected function validar($elemento){
        if (strcmp($elemento,"suma")==0){
            return Operador::SUMA;
        } else if (strcmp($elemento,"resta") == 0){
            return Operador::RESTA;
        } else if (strcmp($elemento,"multiplicacion") == 0){
            return Operador::MULTIPLICACION;
        } else if (strcmp($elemento,"division") == 0){
            return Operador::DIVISION;
        } else {
            throw new \Exception("Operacion no implementada");
        }
    }
}
