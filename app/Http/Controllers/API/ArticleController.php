<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::all();

        return response()->json([
            "success" => true,
            "Message" => "Article List",
            "data" => $article
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'user_id' => 'required',
            'category_id' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/articles/';
            $nameImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $nameImage);
            $input['image'] = "$nameImage";
        }

        $article = Article::create($input);

        return response()->json([
            "success" => true,
            "message" => "Product created successfully",
            "data" => $article
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            "success" => true,
            "message" => "Article retrieved successfully.",
            "data" => Article::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $input = $request->all();

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'user_id' => 'required',
            'category_id' => 'required'
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'images/articles/';
            $nameImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $nameImage);
            $input['image'] = "$nameImage";
        } else {
            unset($input['image']);
        }

        $article->update($input);

        return response()->json([
            "success" => true,
            "message" => "Article updated successfully.",
            "data" => $article
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json([
            "success" => true,
            "message" => "Article deleted successfully.",
            "data" => $article
        ]);
    }
}
