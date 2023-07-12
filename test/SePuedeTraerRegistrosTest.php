<?php

require_once "Class/VentasRepository.php"; 
use PHPUnit\Framework\TestCase;
use MongoDB\Client;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;

class SePuedeTraerRegistrosTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function testShowSql()
    {
        // Preparar datos de prueba
        $table = "RO_T_ARTICULOS_SIN_CN"; // Cambia esto al nombre de la tabla que deseas probar

        // Crear un objeto de la clase que contiene la función showSql

        $myObject = new VentasRepository(); // Cambia 'TuClase' al nombre de tu clase que contiene la función showSql

        // Llamar a la función showSql y obtener el resultado
        $result = $myObject->showSql($table);

        // Verificar el resultado esperado
        $this->assertIsArray($result); // Verifica que el resultado sea un arreglo
        $this->assertNotEmpty($result); // Verifica que el resultado no esté vacío
    }

    public function testShowMongoDb()
    {
        // Preparar datos de prueba
        $collection = "paulo2000000"; // Cambia esto al nombre de la Collection que deseas probar

        // Crear un objeto de la clase que contiene la función showMongoDb

        $myObject = new VentasRepository(); // Cambia 'VentasRepository' al nombre de tu clase que contiene la función showMongoDb

        // Llamar a la función showMongoDb y obtener el resultado
        $result = $myObject->showMongo($collection);

        // Verificar el resultado esperado
        $this->assertIsArray($result); // Verifica que el resultado sea un arreglo
        $this->assertNotEmpty($result); // Verifica que el resultado no esté vacío
    }
}
?>