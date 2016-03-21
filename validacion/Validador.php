<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace calculadoraTDD4\validacion;

/**
 * Description of Validador
 *
 * @author mauri
 */

use calculadoraTDD4\modelo\Operador;

abstract class Validador implements Operador{
    /**
     *
     * @var Operador
     */
    protected $operador;
    protected $criterio;

    public function __construct($operador){
        $this->operador = $operador;
    }
    
    public function operacion($operando1, $operando2, $operacion) {
        return $this->operador->operacion($operando1, $operando2, $operacion);
    }
    
    public function setOperador($operador){
        $this->operador = $operador;
    }
    
    public function setCriterio($criterio){
        $this->criterio = $criterio;
    }
    
    protected abstract function validar($elemento);

}
