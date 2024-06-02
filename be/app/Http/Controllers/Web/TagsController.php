<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use Illuminate\Http\Request;

use App\Models\Tags;

class TagsController extends Controller
{
    public function index(){
        $listTags = Tags::withTrashed()->get();
        return view('/tag/index',compact('listTags'));
    }
    public function createHandle(TagsRequest $request){
        $tag = new Tags();
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tag.index')->with('alert','Successfully created');
    }
    public function editHandle(TagsRequest $request, $id){
        $tag = Tags::find($id);
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tag.index')->with('alert','Successfully edited');
    }
    public function deleteHandle($id){
        $tag = Tags::withTrashed()->find($id);
        if (!$tag) {
            return redirect()->route('tag.index')->with('error','Tag not found');
        }
        if($tag->trashed()){
            $tag->restore();
            return redirect()->route('tag.index')->with('alert','Successfully restored');
        }
        else{
            $tag->delete();
            return redirect()->route('tag.index')->with('alert','Successfully deleted');
        }
    }
}
