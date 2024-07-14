<?php

namespace App\Services;

use App\Models\Log;

class LogService
{
    public function createLog($action, $model = null, $payload = null): void
    {
        Log::create([
            'action' => $action,
            'payload' => $payload,
            'loggable_type' => $model ? get_class($model) : null,
            'loggable_id' => $model ? $model->getKey() : null,
            'user_id' => auth()->id(),
        ]);
    }

    //usage -> (new LogService())->createLog('dashboard page view', auth()->user(), 'viewed_payload');

}
