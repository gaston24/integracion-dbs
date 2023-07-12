<?php

require_once "Class/VentasRepository.php";  
use PHPUnit\Framework\TestCase;
use MongoDB\Client;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class SePuedeCrearUnaCollectionTest extends TestCase
{
    use MockeryPHPUnitIntegration;

 
    public function testCreateCollection()
    {
        // Arrange
        $mockCidMongo = $this->getMockBuilder('VentasRepository') 
            ->disableOriginalConstructor()
            ->getMock();

        $mockCidMongo->expects($this->once())
            ->method('createCollection')
            ->willReturn(true);

        $yourClass = new VentasRepository($mockCidMongo);

        // Act
        $result = $yourClass->createCollection('testCollection');

        // Assert
        $this->assertTrue($result);
    }

}


?>