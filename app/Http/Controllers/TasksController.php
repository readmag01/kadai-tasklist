<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
     if (\Auth::check()) {
         
         $user = \Auth::User();
         $tasks = $user->tasks()->orderby('created_at', 'desc')->paginate(10);
         
         return view('tasks.index', [
             'tasks' => $tasks,
             ]);
    } else {
    
         return view('welcome');
    
     }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new  \App\Task;
        
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required:max:191',
            'status' => 'required|max:10',
            ]);
        
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
            ]);
        
        return redirect()->action('TasksController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = \App\Task::find($id);
        
        if (\Auth::id() === $task->user_id) {
            return view('tasks.show', [
                'task' => $task,
                ]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = \App\Task::find($id);
        
        if (\Auth::id() === $task->user_id) {
            return view('tasks.edit',[ 
                'task' => $task,
                ]);
        } else {
            return redirect('/');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           
        $task = \App\Task::find($id);
        
        if (\Auth::id() === $task->user_id) {
            
            $this->validate($request, [
                'content' => 'required|max:191',
                'status' => 'required|max:10',
                ]);
            
            $task = \App\Task::find($id);
            $task->content = $request->content;
            $task->status = $request->status;
            $task->save();
        }
        
        return redirect('/');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = \App\Task::find($id);
        
        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }
        
        return redirect('/');
    }
}
