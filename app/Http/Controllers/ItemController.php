<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Validator;

class ItemController extends Controller
{

    public function index()
    {
      $item =Item::all();
      return response()->json($item);
    }

    public function create()
    {

    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
          'text' => 'required'
        ]);

        if($validator->fails()){
          $response = array('response' => $validator->messages(), 'success' => false);
          return $response;
        } else {
          // Create item
          $item = new Item;
          $item->title = $request->input('text');
          $item->body = $request->input('body');
          $item->save();

          return response()->json($item);
        }

    }

    public function show($id)
    {
      $item =Item::find($id);
      return response()->json($item);

    }


   

    public function update(Request $request, $id)
    {
         
          // update
        $validator = Validator::make($request->all(),[
          'text' => 'required'
        ]);

        if($validator->fails()){
          $response = array('response' => $validator->messages(), 'success' => false);
          return $response;
        } else{
          $item =  Item::find($id);
          $item->title = $request->input('text');
          $item->body = $request->input('body');
          $item->save();

          return response()->json($item);
      }
        
    }

    public function destroy($id)
    {
         $item =  Item::find($id);
         $item->delete();
         $response = array('response' =>'item delete', 'success' => true);
          return $response;
    }
}
