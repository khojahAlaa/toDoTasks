<?php

namespace App\Http\Controllers;
use App\User;
use App\MyTask;

use Illuminate\Http\Request;

class MyTaskController extends Controller
{
    private $date;
    private $tomorrow;
    
    public function __construct()
    {
        $this->date = \Carbon\Carbon::today();
        
        $this->tomorrow= \Carbon\Carbon::tomorrow();
    }
    public function index()
    {
        $user= auth()->user()->id;
        //somedayTasks
        $countAllMyTasks=  $this->countAllMyTasks($user);
        $myToDoTasks=  $this->myToDoTasks($user);
        $myDoneTasks=  $this->myDoneTasks($user);
        //overDue Tasks
        $overdueTasks=  $this->overdueTasks($user);
        // $countOverdueTasks=  $this->overdueTasks($user)->count();
        //today Tasks
        $todayMyDoneTasks=  $this->todayMyDoneTasks($user);
        $todayMyToDoTasks=  $this->todayMyToDoTasks($user);
        $todayMyTasks=  $this->todayMyTasks($user);
        //tomorrow Tasks
        $tomorrowMyDoneTasks=  $this->tomorrowMyDoneTasks($user);
        $tomorrowMyToDoTasks=  $this->tomorrowMyToDoTasks($user);
        $tomorrowMyTasks=  $this->tomorrowMyTasks($user);

        // dd($todayMyTasks);
        //  return $overdueTasks;
        return view('tasks.myTasks')->with([
            'countAllMyTasks'=>  $countAllMyTasks,
            'myToDoTasks'=> $myToDoTasks,
            'myDoneTasks' => $myDoneTasks,
            'overdueTasks' => $overdueTasks,
            // 'countOverdueTasks' => $countOverdueTasks,
            'todayMyDoneTasks' => $todayMyDoneTasks,
            'todayMyToDoTasks' => $todayMyToDoTasks,
            'todayMyTasks' => $todayMyTasks,
            'tomorrowMyDoneTasks'=>$tomorrowMyDoneTasks,
            'tomorrowMyToDoTasks'=> $tomorrowMyToDoTasks,
            'tomorrowMyTasks' => $tomorrowMyTasks,
        ]);
       
    }
    //----------------------somedayTasks----------------------//
    public function countAllMyTasks($user)
    {
       return MyTask::where('user_id',$user)->count();
    }
    public function myToDoTasks($user)
    {
       return MyTask::where('user_id',$user)
       ->where('dueDate','!=',$this->date )
       ->where('dueDate','!=',$this->tomorrow )
       ->where('dueDate','>',$this->date)
       ->where('is_done',0)
       ->get();
    }
    public function myDoneTasks($user)
    {
       return MyTask::where('user_id',$user)
    //    ->where('dueDate','!=',$this->date )
    //    ->where('dueDate','!=',$this->tomorrow )
    //    ->where('dueDate','>',$this->date)
       ->where('is_done',1)
       ->get();
    }


    //----------------------overDue Tasks----------------------//
    public function overdueTasks($user)
    {
        return MyTask::where('user_id',$user)->where('dueDate','<',$this->date)->where('is_done',0)->get();
    }



    //----------------------today Tasks----------------------//
    public function todayMyDoneTasks($user)
    {   
        return MyTask::where('user_id',$user)->where('dueDate','=',$this->date)->where('is_done',1)->get();
    }
    public function todayMyToDoTasks($user)
    {   
        return MyTask::where('user_id',$user)->where('dueDate','=',$this->date)->where('is_done',0)->get();
    }
    public function todayMyTasks($user)
    {  
        return MyTask::where('user_id',$user)->where('dueDate','=',$this->date)->get();
    }


    //-----------------tomorrow Tasks ----------------------//
    public function tomorrowMyDoneTasks($user)
    {   
        return MyTask::where('user_id',$user)->where('dueDate','=',$this->tomorrow)->where('is_done',1)->get();
    }
    public function tomorrowMyToDoTasks($user)
    {   
        // $tomorrow = \Carbon\Carbon::today()->subDays(1);
        return MyTask::where('user_id',$user)->where('dueDate','=',$this->tomorrow)->where('is_done',0)->get();
    }
    public function tomorrowMyTasks($user)
    {   
        return MyTask::where('user_id',$user)->where('dueDate','=',$this->tomorrow)->get();
    }


    // ----------------------/----------------------//
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       $newTask= $request->user()->MyTasks()->create($request->all());
        if ($request->expectsJson())
        {
            return response()->json([
                'message' => "Your Task has been Created",
                // 'body_html' => $question->body_html
                'task'=>$newTask
            ]);
        }

        return redirect()->route('tasks.myTasks')->with('success', "Your Task has been Created");
    }

    
    public function show($id)
    {   
        $myTask=MyTask::findOrFail($id);
        
        return view('tasks.myTasks', compact('myTask'));
    }

    
    public function isDone(Request $request,$id)
    {
        $task=MyTask::findOrFail($id);
        // $task->update($request->all());
         if(request('is_done') === true)
        {
            $task->is_done = 1;
        }else{
            $task->is_done = 0;
        }
        $task->save();

    }

   
    public function update(Request $request, $id)
    {
        $task=MyTask::findOrFail($id);
        $task->update($request->all());
        if ($request->expectsJson())
        {
            return response()->json([
                'message' => "Your Task has been Updated",
                'updatedtask' => $task
            ]);
        }

        return redirect()->route('tasks.myTasks')->with('success', "Your Task has been Updated");
    }

    
    public function destroy($id , Request $request)
    {
        $task=MyTask::findOrFail($id);
        $task->delete();
        if ($request->expectsJson())
        {
            return response()->json([
                'message' => "Your Task has been Deleted",
                // 'body_html' => $question->body_html
            ]);
        }

        return redirect()->route('tasks.myTasks')->with('success', "Your Task has been Deleted");
    }
}
