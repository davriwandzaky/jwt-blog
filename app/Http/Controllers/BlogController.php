<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends Controller {
    
    public function store (Request $request) 
    {
        $this->validate ($request, [
            'title' => 'required',
            'content' => 'required',
            'author' => 'required'
        ]);

        $blogs = Blog::create(
            $request -> only (['title', 'content', 'author'])
        );

        return response () -> json ([
            'created' => true,
            'data' => $blogs
        ], 201);
    }

    public function index ()
    {
        return Blog::all();
    }

    public function show($id)
    {
        $blogs = Blog::find($id);
        if($blogs){
        return response()->json([
            'message' => 'Book Found',
            'data' => $blogs
        ], 200);
        } else{
            return response()->json([
                'message' => 'Book Not Found.'
            ], 404);
        }
    }

    public function update (Request $request, $id)
        {
            try {
                $blogs = Blog::findorFail($id);
            } catch (ModelNotFoundException $e) {
                return response () -> json ([
                    'message' => 'book not found'
                ], 404);
            }

            $blogs -> fill(
                $request -> only (['title', 'description', 'author'])
            );

            $blogs -> save();

            return response () -> json ([
                'update' => true,
                'data' => $blogs
            ], 200);
        }

    public function destroy($id)
        {
            try {
                $blogs = Blog::findorFail($id);
                
            } catch (ModelNotFoundException $e) {
                return response () -> json ([
                    'error' => [
                        'message' => 'book not found'
                    ]
                ], 404);
            }

            $blogs -> delete();
            return response () -> json([
                'deleted' => true
            ], 200);
        }

}