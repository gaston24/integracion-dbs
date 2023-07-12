<?php

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class SePuedeBorrarUnRegistroTest extends TestCase
{
    use MockeryPHPUnitIntegration;
    
    private $cid_mongo;
    private $mongoCollection;
    
    
    public function testDeleteOne(): void
    {
        // Crea una instancia de la clase que contiene el método deleteOne
        $example = new VentasRepository();

        // Define los parámetros de entrada para el método deleteOne
        $collection = 'testCollection';
        $filter = 'name';
        $value = 'John';

        // Mockear el cliente de MongoDB
        $mongoClientMock = $this->createMock(MongoDB\Client::class);
        $example->mongoClient = $mongoClientMock;

        // Mockear la base de datos y la colección
        $databaseMock = $this->createMock(MongoDB\Database::class);
        $mongoClientMock->expects($this->once())
            ->method('selectDatabase')
            ->with('local')
            ->willReturn($databaseMock);
        $collectionMock = $this->createMock(MongoDB\Collection::class);
        $databaseMock->expects($this->once())
            ->method('selectCollection')
            ->with($collection)
            ->willReturn($collectionMock);

        // Mockear el resultado del método deleteOne
        $deleteResultMock = $this->createMock(MongoDB\DeleteResult::class);
        $deleteResultMock->expects($this->once())
            ->method('getDeletedCount')
            ->willReturn(1);
        $collectionMock->expects($this->once())
            ->method('deleteOne')
            ->with([$filter => $value])
            ->willReturn($deleteResultMock);

        // Llamar al método deleteOne y comprobar el resultado
        $result = $example->deleteOne($collection, $filter, $value);
        $this->assertTrue($result);
    }

}