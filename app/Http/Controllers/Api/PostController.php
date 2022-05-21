<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Person;
use App\Models\Page;
use App\Models\Post;

class PostController extends Controller
{
    
    public function createPostByUser(Request $request)
    {   
        $person = auth('api')->user();

        $post = new Post();
        $post->content = $request->content;
        $post->person_id = $person->id;

        $post->save();
        return response()->json(['msg' => 'Post Created Successfully!']);
    }

    public function createPostByPage($pageId, Request $request)
    {   
        $person = auth('api')->user();

        $post = new Post();
        $post->content = $request->content;
        $post->person_id = $person->id;
        $post->page_id = $pageId;

        $post->save();
        return response()->json(['msg' => 'Post Created Successfully!']);
    }

}
