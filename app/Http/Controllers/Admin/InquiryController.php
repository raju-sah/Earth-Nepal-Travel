<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusType;
use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Models\Inquiry;
use App\Notifications\InquiryNotification;
use App\Traits\DatatableTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InquiryController extends Controller
{
    use DatatableTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Inquiry::query()->select('*')->latest();

            $config = [
                'additionalColumns' => [
                    'status' => function ($row) {
                        return view('components.table.status_dropdown', [
                            'options' => StatusType::toSelectArray(),
                            'selected' => $row->status,
                            'id' => $row->id,
                        ])->render();
                    },
                    'created_at' => function ($row) {
                        return $row->created_at->diffForHumans();
                    }
                ],
                'disabledButtons' => ['status', 'edit'],
                'model' => 'Inquiry',
                'rawColumns' => [],
                'sortable' => false,
                'routeClass' => null,
            ];

            return $this->getDataTable($request, $data, $config)->filter(function ($instance) use ($request) {
                $instance->where('type', $request->contact_type);
            })->make(true);
        }

        return view('admin.inquiry.index', [
            'columns' => ['id', 'name', 'email', 'type', 'phone', 'created_at', 'status'],
        ]);
    }

    public function show(Inquiry $inquiry): View
    {
        return view('admin.inquiry.show', compact('inquiry'));
    }

    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();
        $this->deleteNotification($inquiry);

        return redirect()->route('admin.inquiries.index')->with('error', 'Inquiry Deleted Successfully!');
    }

    public function updateInquiryStatus(Request $request, $id): ?JsonResponse
    {
        try {
            $inquiry = Inquiry::findOrFail($id);
            $inquiryStatus = $request->input('status');

            $inquiry->status = $inquiryStatus;
            $inquiry->save();

            return response()->json(['success' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function inquiryNotification(Inquiry $inquiry)
    {
        return view('admin.inquiry.notification', [
            'inquiry' => $inquiry,
            'templates' => EmailTemplate::pluck('name', 'id'),
        ]);
    }

    private function deleteNotification(Inquiry $inquiry): void
    {
        DB::table('notifications')
            ->where('type', InquiryNotification::class)
            ->whereJsonContains('data->inquiry->id', $inquiry->id)
            ->delete();
    }
}
