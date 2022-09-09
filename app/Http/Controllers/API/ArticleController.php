<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $data = Article::all();
        return response()->json([
            'success' => true,
            'Message' => 'Article List',
            'data' => $data
        ]);
    }
}
