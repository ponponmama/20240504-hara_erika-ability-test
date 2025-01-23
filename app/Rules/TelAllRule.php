<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TelAllRule implements Rule
{
    public function passes($attribute, $value)
    {
        // 電話番号のバリデーションロジック
        $parts = explode('-', $value);
        if (count($parts) !== 3) {
            return false;
        }

        foreach ($parts as $part) {
            if (!preg_match('/^\d{1,5}$/', $part)) {
                return false;
            }
        }

        return strlen(str_replace('-', '', $value)) <= 15;
    }

    public function message()
    {
        return '電話番号は各部分が1〜5桁で、全体として15桁以内である必要があります。';
    }
} 