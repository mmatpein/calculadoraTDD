<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace calculadoraTDD4\validacion;

/**
 * Description of ValidadorLimiteInferior
 *
 * @author mauri
 */

//use calculadoraTDD4\modelo\Operador;

class ValidadorLimiteInferior extends Validador{
    
    function __construct($operador){
        parent::__construct($operador);
    }
    
    public function operacion($operando1, $operando2, $operacion) {
        $this->validar($operando1);
        $this->validar($operando2);
        $resultado = $this->operador->operacion($operando1, $operando2, $operacion);
        $this->validar($resultado);
        return $resultado;
    }

    public function setCriterio($criterio){
        $this->criterio = $criterio;
    }
    
    protected function validar($elemento){
        if (($this->criterio != \NULL) && ($this->criterio > $elemento)){
            throw new \Exception("Límite inferior superado");
        }
    }
}
