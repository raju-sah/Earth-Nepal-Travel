<?php

namespace App\Http\Controllers\Front;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsLetterRequest;
use App\Models\NewsLetter;
use App\Models\User;
use App\Notifications\NewsLetterSubscribedNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

class NewsLetterController extends Controller
{
    public function store(NewsLetterRequest $request): JsonResponse
    {
        $newsLetter = NewsLetter::create($request->validated());
        $users = User::select(['id', 'email'])->where('user_type', UserType::Admin->value)->get();
        Notification::send($users, new NewsLetterSubscribedNotification($newsLetter));

        return response()->json(['message' => 'NewsLetter Created Successfully'], 201);
    }
}
