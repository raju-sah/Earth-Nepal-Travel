<?php

namespace App\Observers;

use App\Models\PackageFaq;

class FaqObserver
{
    public function created(PackageFaq $package_faq): void
    {
        $package_faq->order = PackageFaq::where('package_id', $package_faq->package_id)->max('order') + 1;
        $package_faq->save();
    }

    public function deleted(PackageFaq $package_faq): void
    {
        $lowerPriorityPackageFaqs = PackageFaq::select(['id', 'order'])
            ->where('order', '>', $package_faq->order)
            ->where('package_id', $package_faq->package_id)
            ->get();

        foreach ($lowerPriorityPackageFaqs as $lowerPriorityPackageFaq) {
            $lowerPriorityPackageFaq->order--;
            $lowerPriorityPackageFaq->saveQuietly();
        }
    }
}
