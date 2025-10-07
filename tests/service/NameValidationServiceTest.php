<?php

namespace Tests\Service;

use App\Exception\Validation\Name\EmptyNameException;
use App\Exception\Validation\Name\InvalidNameFormatException;
use App\Service\NameValidationService;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class NameValidationServiceTest extends TestCase
{
    private NameValidationService $service;
    private $logger;

    public function setUp(): void
    {
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->service = new NameValidationService($this->logger);
    }

    // ========================================
    // TESTS FOR validate Name()
    // ========================================
    public function testValidFirstNameWithValidName()
    {
        $result = $this->service->validateFirstName('second');
        $this->assertTrue($result);
    }

    public function testValidLastNameWithValidName()
    {
        $result = $this->service->validateLastName('Louzolo');
        $this->assertTrue($result);
    }

    // ========================================
    // TESTS FOR invalidate Name
    // ========================================

    public function testValidateFirstNameThrowsInvalidFormatException(): void
    {
        $this->expectException(InvalidNameFormatException::class);
        $this->service->validateFirstName('jean14');
    }

    public function testValidateLastNameThrowsInvalidFormatException(): void
    {
        $this->expectException(InvalidNameFormatException::class);
        $this->service->validateLastName('Louzolo_ç8');
    }

    // ========================================
    // TESTS FOR  empty name validation
    // ========================================

    public function testValidateLastNameThrowsEmptyNameException(): void
    {
        $this->expectException(EmptyNameException::class);
        $this->service->validateLastName('');
    }

    public function testValidateFirstNameThrowsEmptyNameException(): void
    {
        $this->expectException(EmptyNameException::class);
        $this->service->validateFirstName('');
    }

    // ========================================
    // TESTS FOR sanitizeName()
    // ========================================
    public function testSanitizeNameTrimsWithSpaces(): void
    {
        // code...
        $result = $this->service->sanitizeName(' Jean Claude ');
        $this->assertEquals('Jean Claude', $result);
    }

    public function testSanitizeNameConvertsToTitleCase(): void
    {
        $result = $this->service->sanitizeName('jean-claude');
        $this->assertEquals('Jean-Claude', $result);
    }
}
