<?php
require_once 'Class/Venta.php';
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class SePuedeEjecutarDoSpSql extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function testExecDoSpSql()
    {
   
        $conexionMock = Mockery::mock('Conexion');
        $conexionMock->shouldReceive('conectarSql')->andReturn('mocked_connection');
        
      
        $venta = new Venta();

    
        $reflection = new ReflectionClass($venta);
        $property = $reflection->getProperty('cid_central');
        $property->setAccessible(true);
        $property->setValue($venta, $conexionMock);

  
        $result = $venta->execDoSpSql('nombre_procedimiento_almacenado');

 
        $this->assertEmpty($result);


    }
    
}