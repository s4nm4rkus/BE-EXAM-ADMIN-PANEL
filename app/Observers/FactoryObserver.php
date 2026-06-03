<?php

namespace App\Observers;

use App\Models\Factory;
use App\Services\ModelEventService;

class FactoryObserver
{
    protected ModelEventService $service;
    protected static array $oldValues = [];

    public function __construct(ModelEventService $service)
    {
        $this->service = $service;
    }

    public function created(Factory $factory): void
    {
        $this->service->logEvent('created', $factory);
    }

    public function updating(Factory $factory): void
    {
        static::$oldValues[$factory->getKey()] = $factory->getOriginal();
    }

    public function updated(Factory $factory): void
    {
        $old = static::$oldValues[$factory->getKey()] ?? [];
        $this->service->logEvent('updated', $factory, $old);
        unset(static::$oldValues[$factory->getKey()]);
    }

    public function deleted(Factory $factory): void
    {
        $this->service->logEvent('deleted', $factory);
    }
}
