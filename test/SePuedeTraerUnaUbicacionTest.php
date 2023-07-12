<?php

use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
require_once 'Class/Ubicacion.php';


class SePuedeTraerUnaUbicacionTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function testTraerUbicaciones()
    {
        // Preparar datos de prueba
        $collection = "Ubicaciones"; // Cambia esto al nombre de la Collection que deseas probar

        // Crear un objeto de la clase que contiene la función showMongoDb
        $myObject = new Ubicacion(); // Cambia 'VentasRepository' al nombre de tu clase que contiene la función showMongoDb

        // Llamar a la función showMongoDb y obtener el resultado
        $result = $myObject->traerUbicaciones();

        // Verificar el resultado esperado
        $this->assertIsArray($result); // Verifica que el resultado sea un arreglo
        $this->assertNotEmpty($result); // Verifica que el resultado no esté vacío
    }
    
}