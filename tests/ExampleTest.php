<?php

namespace Ahinkle\AutoResolvableBladeComponents\Tests;

use Orchestra\Testbench\TestCase;
use Ahinkle\AutoResolvableComponents\AutoResolvableComponentsServiceProvider;

class ExampleTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [AutoResolvableComponentsServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
