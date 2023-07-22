<?php

namespace CodersCantina\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

abstract class TransformRequest extends FormRequest
{
    protected array $transform = [];

    public function input($key = null, $default = null)
    {
        $result = parent::input($key, $default);

        return $this->transformArray($result);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        foreach ($this->getTransform() as $target => $source) {
            if ($target == $key) {
                $key = $source;
                break;
            }
        }

        return parent::get($key, $default);
    }

    protected function transformArray($input)
    {
        $transform = $this->getTransform();
        foreach ($transform as $target => $source) {
            if ($target !== $source && Arr::has($input, $source)) {
                data_set($input, $target, data_get($input, $source));
                unset($input[$source]);
            }
        }

        return $input;
    }

    protected function getTransform(): array
    {
        return $this->transform;
    }
}
