<?php

namespace App\Services\Routing;

use Closure;
use Illuminate\Contracts\Routing\BindingRegistrar;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Binder
{
    /**
     * Apply the bindings to the registrar.
     *
     * @param \Illuminate\Contracts\Routing\BindingRegistrar $registrar
     *
     * @return void
     */
    public function apply(BindingRegistrar $registrar)
    {
        $registrar->bind('template', [$this, 'template']);
    }

    /**
     * Route to a template.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return string
     */
    protected function template(string $value, Route $route)
    {
        throw new NotFoundHttpException();
    }
}
