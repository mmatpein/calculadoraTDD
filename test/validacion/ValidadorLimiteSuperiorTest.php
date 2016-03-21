<?php

namespace calculadoraTDD4\test\validacion;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-02-10 at 12:05:50.
 */
require "vendor/autoload.php";

use calculadoraTDD4\validacion\ValidadorLimiteSuperior;
use CalculadoraTDD4\modelo\Operador;
use calculadoraTDD4\modelo\OperadorBinario;

class ValidadorLimiteSuperiorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Operador
     */
    protected $validadorLimiteSuperior;
    protected $operador;

    const LIMITE_100 = 100;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        //$this->validadorLimiteSuperior = new ValidadorLimiteSuperior(new OperadorBinario());
    }

    /**
     * @dataProvider proveedorLimiteNoSuperado
     */
    public function testLimiteNoSuperado($operando1, $operando2, $limiteSuperior, $operacion, $resultadoEsperado) {
        $operador = $this->getMockBuilder("calculadoraTDD4\modelo\OperadorBinario")->getMock();//new OperadorBinario();
        $operador->expects($this->any())->method("operacion")->will($this->returnValue($resultadoEsperado));
        $this->validadorLimiteSuperior = new ValidadorLimiteSuperior($operador);
        $this->validadorLimiteSuperior->setCriterio($limiteSuperior);
        $resultado = $this->validadorLimiteSuperior->operacion($operando1, $operando2, $operacion);
        $this->assertEquals($resultado, $resultadoEsperado);
    }

    /**
     * 
     * @dataProvider proveedorLimiteSuperado
     */
    public function testLimiteSuperado($operando1, $operando2, $limiteSuperior, $operacion, $resultadoEsperado) {
        $operador = $this->getMockBuilder("calculadoraTDD4\modelo\OperadorBinario")->getMock();//new OperadorBinario();
        $operador->expects($this->any())->method("operacion")->will($this->returnValue($resultadoEsperado));
        $this->validadorLimiteSuperior = new ValidadorLimiteSuperior($operador);
        $this->validadorLimiteSuperior->setCriterio($limiteSuperior);
        try {
            $this->validadorLimiteSuperior->operacion($operando1, $operando2, $operacion);
        } catch (\Exception $ex) {
            $this->assertTrue(true, "La operación ha fallado por superar el límite");
            return;
        }
        $this->fail("No se ha producido una excecpción");
    }

    public function proveedorLimiteNoSuperado() {
        return [
            "LimSup 100: 50+40=90" => [50, 40, 100, Operador::SUMA, 90],
            "LimSup 50: 20+1=21" => [20, 1, 50, Operador::SUMA, 21],
            "LimSup 100: 99-5=94" => [99, -5, 100, Operador::SUMA, 94],
            "LimSup 100: -5+99=94" => [-5, 99, 100, Operador::SUMA, 94]
        ];
    }

    public function proveedorLimiteSuperado() {
        return [
            "LimSup 100: 100+1=ERROR" => [100, 1, 100, Operador::SUMA,101],
            "LimSup 50: 50+1=ERROR" => [50, 1, 50, Operador::SUMA,51],
            "LimSup 100: 101-5=ERROR" => [101, -5, 100, Operador::SUMA,96],
            "LimSup 100: -5+101=ERROR" => [-5, 101, 100, Operador::SUMA,96]
        ];
    }

    protected function tearDown() {
        $this->validadorLimiteSuperior = null;
    }

}
