<?php

namespace CodersCantina\Request\Tests;

use CodersCantina\Request\ApiRequest;
use PHPUnit\Framework\TestCase;

class ApiRequestTest extends TestCase
{
    /** @test */
    public function it_transform_keys()
    {
        $request = FooRequest::create('', 'GET', ['fooBar' => 'baz', 'bar' => 'qux']);

        $this->assertEquals(['foo_bar' => 'baz', 'bar' => 'qux'], $request->all());
        $this->assertEquals('baz', $request->get('foo_bar'));
        $this->assertEquals('qux', $request->get('bar'));
    }

}

class FooRequest extends ApiRequest
{

}
