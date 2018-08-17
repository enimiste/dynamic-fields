<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TagList;

class TagListController extends Controller
{
    public function create() {
        $tags = TagList::all();
        return view('taglist.create', compact('tags'));
    }

    public function store(Request $request) {
        return response()->json(['data'=>['message'=>'Saved!']]);
    }
}
