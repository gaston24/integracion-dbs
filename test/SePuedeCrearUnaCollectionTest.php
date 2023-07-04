<?php 
use PHPUnit\Framework\TestCase;
require_once "Class/VentasRepository.php"; 


interface MongoDBClientInterface {
    public function createCollection($collectionName);
}

interface MongoDBCollectionInterface {
    // Agrega aquí los métodos necesarios para tu test
}

class SePuedeCrearUnaCollectionTest extends TestCase
{
    public function testCreateCollection()
    {
        // Crear una instancia de VentasRepository
        $ventasRepo = new VentasRepository();

        // Mockear el objeto de conexión a MongoDB
        $mongoMock = $this->createMock(MongoDBClientInterface::class);

        // Configurar el mock para que devuelva una colección simulada
        $mongoCollectionMock = $this->createMock(MongoDBCollectionInterface::class);
        $mongoMock->expects($this->once())
            ->method('createCollection')
            ->with($this->equalTo('test_collection'))
            ->willReturn($mongoCollectionMock);

        // Asignar el objeto mock al objeto VentasRepository
        $reflection = new ReflectionClass(VentasRepository::class);
        $property = $reflection->getProperty('cid_mongo');
        $property->setAccessible(true);
        $property->setValue($ventasRepo, $mongoMock);

        // Probar la función createCollection
        $collectionName = 'test_collection';
        $result = $ventasRepo->createCollection($collectionName);

        // Verificar que se haya llamado al método createCollection en el mock
        $this->assertTrue($result);
    }
}

?>