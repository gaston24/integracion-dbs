<?php 

use PHPUnit\Framework\TestCase;
require_once "Class/VentasRepository.php"; 

class VentasRepositoryTest extends TestCase
{
    public function testPasarSqlAmongoDb()
    {
        // Preparación
        $table = 'nombre_de_la_tabla';
        $collectionName = 'nombre_de_la_coleccion';

        // Crear una instancia de Faker
        $faker = Factory::create();

        // Generar datos simulados para la función showSql
        $fakeData = [
            ['campo1' => $faker->name],
            ['campo2' => $faker->email]
        ];

        // Crear una instancia real del repositorio VentasRepository
        $ventas = new VentasRepository();

        // Configurar el resultado esperado para createCollection
        $ventas->createCollection($collectionName);

        // Configurar el resultado esperado para showSql
        $ventas->shouldReceive('showSql')
            ->with($table)
            ->andReturn($fakeData);

        // Configurar el resultado esperado para insertOne
        $ventas->shouldReceive('insertOne')
            ->with(
                $collectionName,
                $this->logicalOr(
                    $this->equalTo(['campo1' => $fakeData[0]['campo1']]),
                    $this->equalTo(['campo2' => $fakeData[1]['campo2']])
                )
            );

        // Instanciar el objeto del controlador
        $controller = new TuController($ventas);

        // Ejecución
        $result = $controller->pasarSqlAmongoDb($table, $collectionName);

        // Afirmar
        $this->assertTrue($result);
    }
}

?>