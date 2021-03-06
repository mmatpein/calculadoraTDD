<?php

namespace calculadoraTDD4\vista;


require 'vendor/autoload.php';
use calculadoraTDD4\modelo\Operador;
/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-03-04 at 17:13:34.
 */
class FormateadorResultadoTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var FormateadorResultado
     */
    protected $formateadorResultado;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->formateadorResultado = new FormateadorResultado;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @dataProvider proveedorOpNameToOpCode
     */
    public function testOpNameToOpCode($nombreOperacion,$codigoOperacion) {
       $codigoOperacionObtenido = $this->formateadorResultado->opNameToOpCode($nombreOperacion);
       $this->assertEquals($codigoOperacion,$codigoOperacionObtenido);
    }

    /**
     * @dataProvider proveedorOpNameError
     */
    public function testOpNameError($nombreOperacion){
        try{
            $this->formateadorResultado->opNameToOpCode($nombreOperacion);
        } catch (\Exception $ex) {
            $this->assertTrue(true);
            return;
        }
        $this->fail("El nombre de operación ".$nombreOperacion." es desconocida");
    }
    
    /**
     * @dataProvider proveedorOpCodeToOpSymbol
     */
    public function testOpCodeToOpSymbol($codigoOperacion,$simboloOperacion) {
       $simboloOperacionObtenido = $this->formateadorResultado->opCodeToOpSymbol($codigoOperacion);
       $this->assertEquals($simboloOperacion,$simboloOperacionObtenido);
    }

    /**
     * @dataProvider proveedorOpCodeError
     */
    public function testOpCodeError($codigoOperacion){
        try{
            $this->formateadorResultado->opCodeToOpSymbol($codigoOperacion);
        } catch (\Exception $ex) {
            $this->assertTrue(true);
            return;
        }
        $this->fail("El código de operación ".$codigoOperacion." es desconocido");
    }
    
    /**
     * @dataProvider proveedorMostrar
     */
    public function testMostrar($operando1, $operando2, $nombreOperacion, $resultado, $cadenaEsperada) {
       $cadenaObtenida = $this->formateadorResultado->mostrar($operando1, $operando2, $nombreOperacion, $resultado);
       $this->assertEquals($cadenaObtenida,$cadenaEsperada);
    }
    
    
    
    public function proveedorOpNameToOpCode(){
        return [
           "suma -> Operador::SUMA" => ["suma",  Operador::SUMA],
           "resta -> Operador::RESTA" => ["resta", Operador::RESTA],
           "multiplicacion => Operador::MULTIPLICACION" => ["multiplicacion", Operador::MULTIPLICACION],
           "division => Operador::DIVISION" => ["division", Operador::DIVISION]
        ];
    }
    
    public function proveedorOpCodeToOpSymbol(){
        return [
          "Operador::SUMA -> '+"  => [Operador::SUMA,'+'],
          "Operador::RESTA -> '-" => [Operador::RESTA,'-'],
          "Operador::MULTIPLICACION -> '*" => [Operador::MULTIPLICACION,'*'],
          "Operador::DIVISION -> '/'" => [Operador::DIVISION,'/']
        ];
    }
    
    public function proveedorMostrar(){
        return [
            "(1,3,'suma',4) => '1+3=4'" => [1,3,'suma',4,"1+3=4"],
            "(5,2,'resta',3) => '5-2=3'" => [5,2,'resta',3,'5-2=3'],
            "(7,2,'multiplicacion',14) => '7*2=14'" => [7,2,'multiplicacion',14,'7*2=14'],
            "(10,2,'division',5) => '10/2=5'" => [10,2,'division',5,'10/2=5']
        ];
    }
    
    public function proveedorOpNameError(){
        return [
            "operación: módulo => ERROR" => ["módulo"],
            "operacion: coseno => ERROR" => ["coseno"]
        ];
    }
    
    public function proveedorOpCodeError(){
        return [
            "Código de operación: -1 => ERROR" => [-1],
            "Código de operación: 5 => ERROR" => [4]
        ];
    }

}
