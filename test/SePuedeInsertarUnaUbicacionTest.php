<?php

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class SePuedeInsertarUnaUbicacionTest extends TestCase
{
    use MockeryPHPUnitIntegration;
    
    private $cid_mongo;
    private $mongoCollection;

    public function testInsertOne()
    {

        $collection = 'Ubicacion';
        
        $document = ['field1' => 'value1', 'field2' => 'value2'];


        $mongoCollectionMock = m::mock(Collection::class);


        $mongoCollectionMock->shouldReceive('insertOne')
            ->with($document)
            ->once();

        $mongoDatabaseMock = m::mock(Database::class);
        $mongoDatabaseMock->shouldReceive('selectCollection')
            ->with($collection)
            ->andReturn($mongoCollectionMock);


        $myMongo = new Ubicacion($mongoDatabaseMock);


        $result = $myMongo->insertOne($collection, $document);


        $this->assertTrue($result);

    }

}
?>