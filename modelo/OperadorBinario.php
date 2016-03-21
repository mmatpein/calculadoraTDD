<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace calculadoraTDD4\modelo;

/**
 * Description of OperadorBinario
 *
 * @author mauri
 */
class OperadorBinario implements Operador{
    

    
    public function operacion($operando1,$operando2,$operacion){
        $resultado = 0;
        switch ($operacion){
            case Operador::SUMA: $resultado = $this->suma($operando1,$operando2);
                                        break;
            case Operador::RESTA: $resultado = $this->resta($operando1, $operando2);
                                        break;
            case Operador::MULTIPLICACION: $resultado = $this->multiplicacion($operando1, $operando2);
                                        break;
            case Operador::DIVISION: $resultado = $this->division($operando1, $operando2);
        }
        return $resultado;
    }
    
    public function suma($operando1,$operando2){
        return $operando1 + $operando2;
    }
    
    public function resta($operando1,$operando2){
        return $operando1-$operando2;
    }
    
    public function multiplicacion($operando1, $operando2){
        return $operando1*$operando2;
    }
    
    public function division($operando1, $operando2){
        return $operando1/$operando2;
    }
    
    public function setLimiteSuperior($limite){
        $this->limiteSuperior = $limite;
    }
}
