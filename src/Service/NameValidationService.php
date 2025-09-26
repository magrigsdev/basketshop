<?php

namespace App\Service;

use App\Exception\Validation\Name\EmptyNameException;
use App\Exception\Validation\Name\InvalidNameFormatException;
use Psr\Log\LoggerInterface;

class NameValidationService
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    /**
     * Validates the given first name.
     *
     * Logs the validation attempt and delegates the actual validation to the validateName method.
     *
     * @param string $firstName the first name to validate
     *
     * @return bool true if the first name is valid, false otherwise
     */
    public function validateFirstName(string $firstName): bool
    {
        $this->logger->debug('firstName validation', ['firstName', $firstName]);

        return $this->validateName($firstName, 'firstName');
    }

    /**
     * Validates the provided last name.
     *
     * Logs the validation attempt and delegates the actual validation to the validateName method.
     *
     * @param string $lastName the last name to validate
     *
     * @return bool true if the last name is valid, false otherwise
     */
    public function validateLastName(string $lastName): bool
    {
        $this->logger->debug('lastName validation', ['firstName', $lastName]);

        return $this->validateName($lastName, 'lasttName');
    }

    /**
     * Validates a given name string for a specific field.
     *
     * Trims the input name and checks if it is empty, throwing an EmptyNameException if so.
     * Ensures the name matches the allowed format (letters, accented characters, spaces, apostrophes, and hyphens),
     * throwing an InvalidNameFormatException if the format is invalid.
     * Logs a debug message on successful validation.
     *
     * @param string $name      the name string to validate
     * @param string $fieldName the name of the field being validated (used for exception and logging)
     *
     * @return bool returns true if the name is valid
     *
     * @throws EmptyNameException         if the trimmed name is empty
     * @throws InvalidNameFormatException if the name does not match the required format
     */
    private function validateName(string $name, string $fieldName): bool
    {
        $trimmeName = trim($name);
        if (empty($trimmeName)) {
            throw new EmptyNameException($fieldName);
        }

        if (!preg_match('/^[a-zA-ZÀ-ÿ\s\'-]+$/', $trimmeName)) {
            throw new InvalidNameFormatException($fieldName);
        }

        $this->logger->debug('name valid successfull',
            [
                'fieldName' => $fieldName,
                'name' => $trimmeName,
            ]);

        return true;
    }

    /**
     * Sanitizes a given name string by trimming whitespace, normalizing spaces,
     * and converting it to title case.
     *
     * @param string $name the input name to sanitize
     *
     * @return string the sanitized name in title case
     */
    public function sanitizeName(string $name): string
    {
        $cleaned = trim($name);
        $cleaned = preg_replace('/\s+/', ' ', $cleaned);
        $cleaned = mb_convert_case($cleaned, MB_CASE_TITLE, 'UTF-8');

        return $cleaned;
    }
}
