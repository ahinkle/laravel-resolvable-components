<?php

namespace Ahinkle\AutoResolvableComponents;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class AutoResolvableComponent extends Component
{
    /**
    * Get the view / view contents that represent the component.
    *
    * @return \Illuminate\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string
    */
    public function render()
    {
        return view('components.' . $this->resolveViewName());
    }

     /**
     * Get the view name relative to the components directory.
     *
     * @return string
     */
    protected function resolveViewName()
    {
        return $this->componentName ?: Str::kebab(class_basename(get_class($this)));
    }
}
