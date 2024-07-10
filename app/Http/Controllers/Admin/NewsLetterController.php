<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Models\NewsLetter;
use App\Notifications\NewsLetterSubscribedNotification;
use App\Traits\DatatableTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsLetterController extends Controller
{
    use DatatableTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = NewsLetter::query()->select(['id', 'email'])->latest();

            $config = [
                'additionalColumns' => [],
                'disabledButtons' => ['edit', 'status', 'view'],
                'model' => 'NewsLetter',
                'rawColumns' => [],
                'sortable' => false,
                'routeClass' => null,
            ];

            return $this->getDataTable($request, $data, $config)->make(true);
        }

        return view('admin.newsletter.index', [
            'columns' => ['email'],
        ]);
    }

    public function destroy(NewsLetter $newsletter): RedirectResponse
    {
        $newsletter->delete();

        return redirect()->route('admin.newsletters.index')->with('error', 'NewsLetter Deleted Successfully!');
    }
    public function newsletterNotification(NewsLetter $newsLetter): RedirectResponse
    {
        return redirect()->route('admin.newsletters.index');
    }
    private function deleteNotification(NewsLetter $newsLetter): void
    {
        DB::table('notifications')
            ->where('type', NewsLetterSubscribedNotification::class)
            ->whereJsonContains('data->newsLetter->id', $newsLetter->id)
            ->delete();
    }
}
