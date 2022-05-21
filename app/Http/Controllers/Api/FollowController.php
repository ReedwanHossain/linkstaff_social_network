<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Page;
use App\Models\Post;
use App\Models\Follow;

class FollowController extends Controller
{
    
    public function followPerson($personId)
    {   
        $person = auth('api')->user();


        // Check if Person with given Id Exist
        if(!Person::where('id',$personId)->exists()){
            return response()->json([
                'message' => 'Person Not Found',
                'status' => 404
            ],404);
        }


        $follow = new Follow();
        $follow->person_id = $personId;
        $follow->follow_person_id = $person->id;
        
        $follow->save();
        return response()->json(['msg' => $person->first_name.' Started Follwing a Person']);
    }


    public function followPage($pageId)
    {   
        $person = auth('api')->user();

        
        // Check if Page with given Id Exist
        if(!Page::where('id',$pageId)->exists()){
            return response()->json([
                'message' => 'Page Not Found',
                'status' => 404
            ],404);
        }

        $follow = new Follow();
        $follow->page_id = $pageId;
        $follow->follow_person_id = $person->id;
        
        $follow->save();
        return response()->json(['msg' => $person->first_name.' Started Follwing a Page']);
    }


    // public function personFeed()
    // {
    //     $person = auth('api')->user();
        
    // }
}
