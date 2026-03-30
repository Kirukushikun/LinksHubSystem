<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HubController extends Controller
{
    public function index()
    {
        $categories = Category::with(['links' => function ($q) {
            $q->orderBy('order');
        }])->orderBy('order')->get();

        return view('hub', compact('categories'));
    }
}