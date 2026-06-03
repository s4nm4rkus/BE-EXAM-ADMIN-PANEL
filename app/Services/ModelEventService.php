<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ModelEventService
{
    public function logEvent(string $event, $model, array $oldValues = []): void
    {
        $data = [
            'event'      => $event,
            'model'      => get_class($model),
            'record_id'  => $model->id,
            'user_id'    => Auth::id(),
        ];

        if ($event === 'updated' && !empty($oldValues)) {
            $changed = array_keys($model->getChanges());
            $data['old_values'] = array_intersect_key($oldValues, array_flip($changed));
            $data['new_values'] = $model->getChanges();
        }


        Log::info('Model Event', $data);
    }
}
