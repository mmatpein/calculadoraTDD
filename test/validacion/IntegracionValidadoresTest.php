<?php

namespace calculadoraTDD4\test\validacion;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-02-10 at 12:05:50.
 */
require "vendor/autoload.php";

use calculadoraTDD4\validacion\ValidadorOperacion;
use calculadoraTDD4\validacion\ValidadorLimiteInferior;
use calculadoraTDD4\validacion\ValidadorLimiteSuperior;
use calculadoraTDD4\modelo\Operador;
use calculadoraTDD4\modelo\OperadorBinario;


class IntegracionValidadoresTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Operador
     */
    protected $operadorValidado;
    

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        //$this->validadorLimiteSuperior = new ValidadorLimiteSuperior(new OperadorBinario());
    }


    /**
     * @dataProvider proveedorOperacionValida
     */
    public function testOperacionValida($operando1,$operando2,$limiteInferior,$limiteSuperior,$operacion,$resultadoEsperado){
        $operador = $this->getMockBuilder("calculadoraTDD4\modelo\OperadorBinario")->getMock();//OperadorBinario();
        $operador->expects($this->any())->method("operacion")->will($this->returnValue($resultadoEsperado));
        
        $this->operadorValidado = $this->getOperadorValidado($operador, $limiteInferior, $limiteSuperior);

        $resultado = $this->operadorValidado->operacion($operando1,$operando2,$operacion);
        $this->assertEquals($resultado,$resultadoEsperado);
    }
    
    /**
     * 
     * @dataProvider proveedorOperacionNoValida
     */
    public function testOperacionNoValida($operando1,$operando2,$limiteInferior,$limiteSuperior,$operacion,$resultadoEsperado){
        $operador = $this->getMockBuilder("calculadoraTDD4\modelo\OperadorBinario")->getMock();//OperadorBinario();
        $operador->expects($this->any())->method("operacion")->will($this->returnValue($resultadoEsperado));
        
        $this->operadorValidado = $this->getOperadorValidado($operador, $limiteInferior, $limiteSuperior);
        try{
            $this->validadorOperacion->operacion($operando1,$operando2,$operacion);
        } catch (\Exception $ex) {
            $this->assertTrue(true,$ex->getMessage());
            return;
        }
        $this->fail("No se ha producido una excecpción");
    }
    
    public function proveedorOperacionValida(){
        return [
            "50+40;LimInf:-100;LimSup:100 -> 90" => [50,40,-100,100,"suma",90],
            "20-1;LimInf:-20;LimSup:20 -> 19" => [20,1,-20,20,"resta",19],
            "10*3;LimInf:-40;LimSup:40 -> 30" => [10,3,-40,40,"multiplicacion",30],
            "10/2;LimInf:0;LimSup:10 -> 5" => [10,2,0,10,"division",5]
        ];
    }
    
    public function proveedorOperacionNoValida(){
        return [
            "'surma';LimInf:-10;LimSup:10 -> ERROR" => [0,0,-10,10,"surma",0],
            "'x4fss';LimInf:-10;LimSup:10 -> ERROR" => [0,0,-10,10,"x4fss",0],
            "'<3fs>';LimInf:-10;LimSup:10 -> ERROR" => [0,0,-10,10,"<3fs>",0],
            "30-40;LimInf:-30;LimSup:30 -> ERROR" => [30,40,-30,30,"resta",-10],
            "2+2;LimInf:-3;LimSup:3 -> ERROR" => [2,2,-3,3,"suma",4]
        ];
    }
    
    public function getOperadorValidado($operador,$limiteInferior,$limiteSuperior){
        $validadorLimInf = new ValidadorLimiteInferior($operador);
        $validadorLimInf->setCriterio($limiteInferior);
        $validadorLimInfSup = new ValidadorLimiteSuperior($validadorLimInf);
        $validadorLimInfSup->setCriterio($limiteSuperior);
        $validadorOpLimInfSup = new ValidadorOperacion($validadorLimInfSup);
        return $validadorOpLimInfSup;
    }
}
