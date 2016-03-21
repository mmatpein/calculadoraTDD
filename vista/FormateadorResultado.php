<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace calculadoraTDD4\vista;

/**
 * Description of FormateadorResultado
 *
 * @author mauri
 */

use calculadoraTDD4\modelo\Operador;

class FormateadorResultado {
    public function opNameToOpCode($nombreOperacion){
        if (strcmp($nombreOperacion,"suma")==0){
            return Operador::SUMA;
        } else if (strcmp($nombreOperacion,"resta")==0){
            return Operador::RESTA;
        } else if (strcmp($nombreOperacion,"multiplicacion")==0){
            return Operador::MULTIPLICACION;
        } else if (strcmp($nombreOperacion,"division")==0){
            return Operador::DIVISION;
        } else {
            echo $nombreOperacion." DESCONOCIDA";
            throw new \Exception("Nombre de operación desconocida");
        }
    }
    
    public function opCodeToOpSymbol($codigoOperacion){
        switch($codigoOperacion){
            case 0: return "+";
                    break;
            case 1: return "-";
                    break;
            case 2: return "*";
                    break;
            case 3: return "/";
                    break;
            default: echo $codigoOperacion." -> DESCONOCIDA";
                     throw new \Exception("Código de operación desconocido");
        }
    }
    
    public function mostrar($operando1,$operando2,$operacion,$resultado){
        $opCode = $this->opNameToOpCode($operacion);
        $simboloOp = $this->opCodeToOpSymbol($opCode);
        return $operando1.$simboloOp.$operando2."=".$resultado;
    }
}
