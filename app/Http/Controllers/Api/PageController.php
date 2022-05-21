<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Page;
use App\Models\Post;

class PageController extends Controller
{
    //
    public function createPage(Request $request)
    {   
        $person = auth('api')->user();

        $page = new Page();
        $page->page_name = $request->page_name;
        $page->person_id = $person->id;

        $page->save();
        return response()->json(['msg' => 'Page Created Successfully!']);
    }
}
