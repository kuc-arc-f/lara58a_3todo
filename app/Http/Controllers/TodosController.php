<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Todo;

//
class TodosController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**************************************
     *
     **************************************/
    public function index(Request $request)
    {   
        $complete = 0;
        $user_id = Auth::id();
        $inputs = $request->all();
        if(isset($inputs["complete"]) ){
            $complete = $inputs["complete"];
        }
        $todos = Todo::orderBy('id', 'desc')
        ->where("complete" , $complete)
        ->where("user_id" , $user_id )
        ->get();
//debug_dump($todos->toArray() );
//exit();
//        ->paginate(10 );
        return view('todos/index')->with('todos', $todos );
    }    
    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('todos/create')->with('todo', new Todo());
    }    
    /**************************************
     *
     **************************************/    
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $inputs = $request->all();
        $inputs["complete"] = 0;
        $inputs["user_id"] = $user_id;
//debug_dump( $inputs );
        $todo = new Todo();
        $todo->fill($inputs);
        $todo->save();
        session()->flash('flash_message', '保存が完了しました');
        return redirect()->route('todos.index');
    }
    /**************************************
     *
     **************************************/
    public function show($id)
    {
        $todo = Todo::find($id);
        $complete_items = $this->get_complete_items();
        return view('todos/show')->with(compact('todo', 'complete_items') );        
    }    
    /**************************************
     *
     **************************************/
    private function get_complete_items(){
        $items =  array(
            '0' => '未完了', '1' => '完了済',
        );
        return $items;
    }
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $todo = Todo::find($id);
        $complete_items = $this->get_complete_items();
        return view('todos/edit')->with(compact('todo', 'complete_items') );
    }
    /**************************************
     *
     **************************************/
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->fill($request->all());
        $todo->save();
        session()->flash('flash_message', '保存が完了しました');
        return redirect()->route('todos.index');
    }
    /**************************************
     *
     **************************************/
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        session()->flash('flash_message', '削除が完了しました');
        return redirect()->route('todos.index');
    }    


}
