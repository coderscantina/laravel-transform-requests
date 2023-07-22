<?php

namespace CodersCantina\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ApiRequest extends FormRequest
{
    public function input($key = null, $default = null)
    {
        $result = parent::input($key, $default);
        foreach ($result as $key => $value) {
            $newKey = Str::snake($key);
            if ($key !== $newKey) {
                $result[$newKey] = $value;
                unset($result[$key]);
            }
        }

        return $result;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return parent::get(Str::camel($key), $default);
    }
}
