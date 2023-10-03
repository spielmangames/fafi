<?php

declare(strict_types=1);

namespace name_generator;

class StringGenerator
{
    public const ALPHABET = 'abcdefghijklmnopqrstuvwxyz';
    public const ALPHABET_VOWELS = 'aeijouy';


    public function generateRandomString(int $minLength, int $maxLength, ?int $vowelsMultiplier = null): string
    {
        $alphabet = self::ALPHABET;
        if (!is_null($vowelsMultiplier)) {
            $alphabet = $this->increaseVowelsQty(self::ALPHABET, self::ALPHABET_VOWELS, 3);
        }

        $generated = '';

        $length = mt_rand($minLength, $maxLength);
        for ($i = 1; $i <= $length; $i++) {
            $generated .= $this->selectRandomChar($alphabet);
        }

        return $generated;
    }

    private function increaseVowelsQty(string $baseAlphabet, string $alphabetToExtend, int $multiplier): string
    {
        $toExtend = mb_str_split($alphabetToExtend);
        $extended = array_map(
            fn(string $char): string => str_repeat($char, $multiplier),
            $toExtend
        );

        return str_replace($toExtend, $extended, $baseAlphabet);
    }

    public function selectRandomChar(string $alphabet): string
    {
        $i = mt_rand(0, mb_strlen($alphabet) - 1);
        return $alphabet[$i];
    }
}
