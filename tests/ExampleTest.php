<?php

namespace Ahinkle\AutoResolvableBladeComponents\Tests;

use Orchestra\Testbench\TestCase;
use Ahinkle\AutoResolvableComponents\AutoResolvableComponentsServiceProvider;
use PHPUnit\Framework\Attributes\Test;

class ExampleTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [AutoResolvableComponentsServiceProvider::class];
    }
    
    #[Test]
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
