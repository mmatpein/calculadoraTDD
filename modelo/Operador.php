<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace calculadoraTDD4\modelo;

/**
 *
 * @author mauri
 */
interface Operador {
    const SUMA=0;
    const RESTA=1;
    const MULTIPLICACION=2;
    const DIVISION=3;
    public function operacion($operando1,$operando2,$operacion);
}
