<?php


namespace App\Jumia\Resource\Customer;


interface CustomerResourceInterface
{
    public function setName(string $name): void;
    public function setPhone(string $phone): void;
    public function setCountry(string $country): void;
    public function setCode(string $code): void;
    public function setState(bool $state): void;
    public function getName(): string;
    public function getPhone(): string;
    public function getCountry(): string;
    public function getState(): bool;
}
