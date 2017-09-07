<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests\Validation;
use Validator;

class Todo_controller extends Controller
{   
    //Function to get data and give view
    public function index(){
        return view('index', ['tasks'=> Task::all()] );
    }
    
    public function prioritize(){
        return view('index', ['tasks'=> Task::orderBy('priority', 'DESC')->get()] );
            }

     /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:25',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('')
                        ->withErrors($validator)
                        ->withInput();
        }else{
        $todo = new Task;
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->save();
        }
        return redirect('');
    }
    
    public function update($id){
        $task = Task::find($id);
        $task['done'] = !$task['done'];
    
        $task->save();
        return redirect('');
    }
   
    public function delete($id){
        Task::find($id)->delete();

        return redirect('');
    }

    public function priority($id){
        $task = Task::find($id);
        echo("test");
        $task['priority'] = !$task['priority'];
        $task->save();
        return redirect('');
    }
    public function ajax(Request $sort){
        $token = $sort->input('_token');
        $sort = $sort->input('sort');
        if($sort == true){
            $tasks = Task::orderBy('priority', 'DESC')->get();
            $text = "<button onClick='test(0);'>Turn priority off</button>";
        }else{
            $tasks = Task::all();
            $text = "<button onClick='test(1);'>Turn priority on</button>";
        }
        $parsedHTML = [];
        $done = "";
        $todo = "";
        foreach( $tasks as $task){
            if( $task->done ){
                $done = $done . view('partials.task', ["task"=> $task]);
            } else {
                $todo = $todo . view('partials.task', ["task"=> $task]);
            }
        }
        return [$todo, $done, $text, $token];

    }
}
