<?php

namespace App\Observers;

use App\Models\Equipment;

class EquipmentObserver
{
    public function created(Equipment $equipment): void
    {
        $equipment->order = Equipment::where('package_id', $equipment->package_id)->max('order') + 1;
        $equipment->save();
    }

    public function deleted(Equipment $equipment): void
    {
        $lowerPriorityEquipments = Equipment::select(['id', 'order'])
            ->where('order', '>', $equipment->order)
            ->where('package_id', $equipment->package_id)
            ->get();

        foreach ($lowerPriorityEquipments as $lowerPriorityEquipment) {
            $lowerPriorityEquipment->order--;
            $lowerPriorityEquipment->saveQuietly();
        }
    }
}
