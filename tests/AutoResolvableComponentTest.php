<?php

namespace Ahinkle\AutoResolvableComponents\Tests;

use Ahinkle\AutoResolvableComponents\AutoResolvableComponent;
use Illuminate\Config\Repository as Config;
use Illuminate\Container\Container;
use Illuminate\Contracts\View\Factory as FactoryContract;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class AutoResolvableComponentTest extends TestCase
{
    protected $viewFactory;
    protected $config;

    public function setUp(): void
    {
        $this->config = m::mock(Config::class);

        $container = new Container;

        $this->viewFactory = m::mock(Factory::class);

        $container->instance('view', $this->viewFactory);
        $container->alias('view', FactoryContract::class);
        $container->instance('config', $this->config);

        Container::setInstance($container);
        Facade::setFacadeApplication($container);

        parent::setUp();
    }

    protected function tearDown(): void
    {
        m::close();

        Facade::clearResolvedInstances();
        Facade::setFacadeApplication(null);
        Container::setInstance(null);
        Component::flushCache();
        Component::forgetFactory();

        parent::tearDown();
    }

    /** @test */
    public function it_can_extend_with_inline_view_component()
    {
        $this->config->shouldReceive('get')->once()->with('view.compiled')->andReturn('/tmp');
        $this->viewFactory->shouldReceive('exists')->once()->andReturn(false);
        $this->viewFactory->shouldReceive('addNamespace')->once()->with('__components', '/tmp');

        $component = new TestInlineViewComponent();
        $this->assertSame('__components::c6327913fef3fca4518bcd7df1d0ff630758e241', $component->resolveView());
    }

    /** @test */
    public function it_returns_regular_view()
    {
        $view = m::mock(View::class);
        $this->viewFactory->shouldReceive('make')->once()->with('alert', [], [])->andReturn($view);

        $component = new TestRegularViewComponent();

        $this->assertSame($view, $component->resolveView());
    }

    /** @test */
    public function it_returns_regular_view_name()
    {
        $this->viewFactory->shouldReceive('exists')->once()->andReturn(true);
        $this->viewFactory->shouldReceive('addNamespace')->never();

        $component = new TestRegularViewNameViewComponent();

        $this->assertSame('alert', $component->resolveView());
    }

    /** @test */
    public function it_resolves_missing_render_view()
    {
        $view = m::mock(View::class);
        $this->viewFactory->shouldReceive('make')->once()->with('components.test-missing-render-component', [], [])->andReturn($view);

        $component = new TestMissingRenderComponent();

        $this->assertSame($view, $component->resolveView());
    }
}
class TestInlineViewComponent extends AutoResolvableComponent
{
    public $title;

    public function __construct($title = 'foo')
    {
        $this->title = $title;
    }

    public function render()
    {
        return 'Hello {{ $title }}';
    }
}

class TestRegularViewComponent extends AutoResolvableComponent
{
    public $title;

    public function __construct($title = 'foo')
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('alert');
    }
}

class TestRegularViewNameViewComponent extends AutoResolvableComponent
{
    public $title;

    public function __construct($title = 'foo')
    {
        $this->title = $title;
    }

    public function render()
    {
        return 'alert';
    }
}

class TestHtmlableReturningViewComponent extends AutoResolvableComponent
{
    protected $title;

    public function __construct($title = 'foo')
    {
        $this->title = $title;
    }

    public function render()
    {
        return new HtmlString("<p>Hello {$this->title}</p>");
    }
}

class TestMissingRenderComponent extends AutoResolvableComponent
{
    public $title;

    public function __construct($title = 'foo')
    {
        $this->title = $title;
    }
}
