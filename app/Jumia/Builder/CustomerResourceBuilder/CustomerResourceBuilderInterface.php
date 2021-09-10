<?php
namespace App\Jumia\Builder\CustomerResourceBuilder;

use App\Jumia\Validator\ValidatorInterface;

interface CustomerResourceBuilderInterface
{
    public function name(string $name);
    public function country(string $phone);
    public function phone(string $phone);
    public function phoneState(ValidatorInterface $validator);
    public function build();

}
