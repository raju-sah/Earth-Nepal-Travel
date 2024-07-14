<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CommonFaq;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        return view('front.pages.faq', [
            'faqs' => CommonFaq::select('id', 'question', 'answer')->active()->get(),
        ]);
    }
}
