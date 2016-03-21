<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of indexTest
 *
 * @author mauri
 */

require 'vendor/autoload.php';

use Facebook\WebDriver\Remote\WebDriverCapabilityType;
//use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class indexTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected $webDriver;

    public function setUp() {
        //$capabilities = DesiredCapabilities::firefox();
        $capabilities = array(WebDriverCapabilityType::BROWSER_NAME => 'firefox');
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
    }

    public function tearDown() {
        $this->webDriver->close();
    }

    protected $url = 'http://localhost/asignaturas/ed/calculadoraTDD4/';

    
    /**
     * @dataProvider proveedorTestSistemaOperacion
     */
    public function testSistemaOperacion($operando1,$operando2,$botonRadioOperacion,$limiteInferior,$limiteSuperior,$descripcionOperacionEsperada) {
        $this->webDriver->get($this->url);
        // checking that page title contains word 'NetBeans'
        
        $this->webDriver->findElement(WebDriverBy::id("operando1"))->clear()->sendKeys($operando1);
        $this->webDriver->findElement(WebDriverBy::id("operando2"))->clear()->sendKeys($operando2);
        $this->webDriver->findElement(WebDriverBy::id("limite_inferior"))->clear()->sendKeys($limiteInferior);
        $this->webDriver->findElement(WebDriverBy::id("limite_superior"))->clear()->sendKeys($limiteSuperior);
        $this->webDriver->findElement(WebDriverBy::id($botonRadioOperacion))->click();
        $this->webDriver->findElement(WebDriverBy::id("submit_operacion"))->click();
        
        $descripcionOperacionObtenida = $this->webDriver->findElement(WebDriverBy::id("descripcion_operacion"))->getText();
        
        $this->assertEquals($descripcionOperacionObtenida,$descripcionOperacionEsperada);
        //$this->assertContains('NetBeans', $this->webDriver->getTitle());
    }
    
    public function testSistemaOperacionDatosIncorrectos(){
        $urlIncorrecta = "http://localhost/asignaturas/ed/calculadoraTDD4/controlador/calcularOperacion.php?operando1=fasv&operando2=xar4&operacion=suma&limite_inferior=-10&limite_superior=ax";
        $this->webDriver->get($urlIncorrecta);
        $descripcionOperacionObtenida = $this->webDriver->findElement(WebDriverBy::id("descripcion_operacion"))->getText();
        $this->assertEquals($descripcionOperacionObtenida,"No es posible calcular la operación");
    }
    
    public function proveedorTestSistemaOperacion(){
        return [
            "Límites: (-10,10); Operacion: 1+1=2" => [1,1,"radio_sumar",-10,10,"1+1=2"],
            "Límites: (-10,10); Operacion: 1-1=0" => [1,1,"radio_restar",-10,10,"1-1=0"],
            "Límites: (-100,100); Operacion: 7*8=56" => [7,8,"radio_multiplicar",-100,100,"7*8=56"],
            "Límites: (-100,100); Operacion: 20/4=5" => [20,5,"radio_dividir",-100,100,"20/5=4"],
            "Límites: (-5,5); Operacion: 3+3=>ERROR" => [3,3,"radio_sumar",-5,5,"Límite superior superado"],
            "Límites: (-5,5); Operacion: 6-2=>ERROR" => [6,2,"radio_restar",-5,5,"Límite superior superado"],
            "Límites: (-5,5); Operacion: -3-3=>ERROR" => [-3,3,"radio_restar",-5,5,"Límite inferior superado"],
            "Límites: (-5,5); Operacion: 3-9=>ERROR" => [3,9,"radio_restar",-5,10,"Límite inferior superado"]
        ];
    }

}
