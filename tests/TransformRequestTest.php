<?php namespace CodersCantina\Request\Tests;

use CodersCantina\Request\TransformRequest;
use PHPUnit\Framework\TestCase;

class TransformRequestTest extends TestCase
{
    /** @test */
    public function it_transforms_an_request()
    {
        $request = FooRequestTransform::create('/', 'POST', ['bar' => 'baz']);

        $this->assertEquals(['foo' => 'baz'], $request->all());
        $this->assertEquals('baz', $request->get('foo'));
    }

    /** @test */
    public function it_passes_other_params_untransformed()
    {

        $request = FooRequestTransform::create('/', 'POST', ['bar' => 'baz', 'abc' => 'xyz']);

        $this->assertEquals(['foo' => 'baz', 'abc' => 'xyz'], $request->all());
        $this->assertEquals('baz', $request->get('foo'));
        $this->assertEquals('xyz', $request->get('abc'));
    }
}

class FooRequestTransform extends TransformRequest
{
    protected array $transform = [
        'foo' => 'bar'
    ];
}
