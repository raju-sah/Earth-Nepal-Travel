<?php

namespace App\Services;

use Illuminate\Http\Request;

class ApiRelationService
{
    /**
     * Get the API relation data.
     *
     * @param  Request  $request  The request object
     * @param  string  $data
     * @param  array  $config
     * @return array
     */

    public function getApiRelationData(Request $request, string $data, array $config): array
    {
        $perPage = $request->input('per_page');

        $record = $config['model']::with($config['relation'] . ':id,' . $config['fields'])
            ->active()
            ->where($config['column'], $data)
            ->firstOrFail();

        $items = $record->{$config['relation']}()->paginate($perPage);

        return $config['resourceClass']::collection($items)->response()->getData(true);
    }
}
