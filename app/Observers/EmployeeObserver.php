<?php

namespace App\Observers;

use App\Models\Employee;
use App\Services\ModelEventService;

class EmployeeObserver
{
    protected ModelEventService $service;
    protected static array $oldValues = [];

    public function __construct(ModelEventService $service)
    {
        $this->service = $service;
    }

    public function created(Employee $employee): void
    {
        $this->service->logEvent('created', $employee);
    }

    public function updating(Employee $employee): void
    {
        static::$oldValues[$employee->getKey()] = $employee->getOriginal();
    }

    public function updated(Employee $employee): void
    {
        $old = static::$oldValues[$employee->getKey()] ?? [];
        $this->service->logEvent('updated', $employee, $old);
        unset(static::$oldValues[$employee->getKey()]);
    }

    public function deleted(Employee $employee): void
    {
        $this->service->logEvent('deleted', $employee);
    }
}
