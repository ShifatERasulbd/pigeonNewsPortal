<?php

namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;

class LeadNewsController extends Controller
{
    //
    public function TopLead()
    {
        //
        $news = News::where('TopLead', 1)->get();
        return view('backend.news.top-lead-news', compact('news'));
    }
    public function lead()
    {
        //
        $news = News::where('lead_news', 1)->get();
        return view('backend.news.lead-news', compact('news'));
    }
}
