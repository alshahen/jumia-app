<?php


namespace App\Jumia\Validator\Rules;


use App\Jumia\Validator\ValidatorInterface;


class CountryPhoneNumberValidator implements ValidatorInterface
{
    private $patterns;

    private $value;

    public function __construct($value)
    {
        $this->patterns = config('country_patterns');

        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {

        foreach ($this->patterns as $pattern) {
            if (preg_match($pattern['pattern'], $this->value, $matches, PREG_OFFSET_CAPTURE, 0)) {
                return true;
            }
        }

        return false;
    }

}
