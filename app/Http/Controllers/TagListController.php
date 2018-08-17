<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TagList;

class TagListController extends Controller
{
    /**
     *
     */
    public function create() {
        $tags = TagList::all();
        return view('taglist.create', compact('tags'));
    }

    /**
     *
     */
    public function store(Request $request) {
        $validator = \Validator::make($request->all(), [
            'tags'=>['required', 'array'],
            'tags.*.value'=>['required', 'string', 'min:3', 'max:200']
        ]);
        if($validator->fails()){
            return response()->json([
                'data'=> ['errors'=>$validator->errors()->toArray()]
            ], 400);
        } else {
            \DB::transaction(function() use ($request) {
                    TagList::query()->delete();
                    collect($request->input('tags'))->map(function($t){
                        return ['name'=>$t['value']];
                    })->each(function($tag){
                        TagList::create($tag);
                    });

            });
            return response()->json(['data'=>['message'=>'Saved!']]);
        }
    }
}
