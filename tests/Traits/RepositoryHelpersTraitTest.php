<?php

namespace App\Tests\Traits;


use App\Exception\TableNotAllowedException;
use App\Traits\RepositoryHelpersTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RepositoryHelpersTraitTest extends KernelTestCase
{
    
    protected function setUp(): void
    {
        self::bootKernel();
    }
    //****************** PRIVATE FUNCTION */
    private function getDummyRepository():object
    {
        return new class {
            use RepositoryHelpersTrait;
        };
    }

    private function callsAllowedTable($object,string $method, string $table)
    {
        $reflection = new \ReflectionClass($object);
        $method = $reflection->getMethod($method);
        $method->setAccessible(true);
        return $method->invoke($object, $table);
    }
    // ************************* TEST PRIVATE FUNCTIONS **************

    
    public function testIsAllowedTableReturnsTrueForAllowedTable()
    {
        $rep = $this->getDummyRepository();
        $result = $this->callsAllowedTable($rep,'isAllowedTable',"products"); 
        $this->assertTrue($result);
    }
    public function testIsAllowedTableThrowsExceptionForForbidenTable()
    {
        $rep = $this->getDummyRepository();
        $this->expectExceptionMessage("Table exemple_table non autorisée.");
        $this->callsAllowedTable($rep,"isAllowedTable","exemple_table");
        
    }

    // public function testFindByEmailReturnNullWhenEmailNotFound()
    // {

    // }

    public function testFindByEmailThrowsExceptionForInvalidTable()
    {
        $this->expectException(TableNotAllowedException::class);
        $rep = $this->getDummyRepository();
        $rep->findByEmail('invalid_table','test@gmail.com');
    }
}