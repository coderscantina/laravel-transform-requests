# Laravel Transform Request from Coder's Cantina

A form request wrapper for applying transformations to incoming requests

## Features

* Use `TransformRequest` to specify an array of key replacements
* Use `ApiRequest` to transform all input from camelCase to snake_case

## Getting started

* Install this package

## Install

Require this package with composer:

``` bash
$ composer require coderscantina/laravel-transform-requests
```

## Usage

Define a new ApiRequest:

```php
<?php namespace App;
 
use Neon\Request\ApiRequest;
 
class TestApiRequest extends ApiRequest
{

}
```
Define a new TransformRequest:

* Override the `$transform` field to define your transformations
* To further customize the transformation override `getTransform`

```php
<?php namespace App;
 
use Neon\Request\TransformRequest;
 
class TestTransformRequest extends TransformRequest
{
    protected $transform = [
        'foo_bar' => 'fooBar',
    ];

}
```

In your application, use the request as you would any other request:

```bash
curl -X POST -d '{"fooBar": "baz"}' https://localhost/
```

```php
<?php

class TestController extends \Illuminate\Routing\Controller
{
    public function a(TestTransformRequest $request)
    {
        $request->get('foo_bar'); // 'baz'
        $request->all(); // -> ['foo_bar' => 'baz']
    }
    
    public function b(TestApiRequest $request)
    {
        $request->get('foo_bar'); // 'baz'
        $request->all(); // -> ['foo_bar' => 'baz']
    }
}
```

## Testing

``` bash
$ composer test
```
