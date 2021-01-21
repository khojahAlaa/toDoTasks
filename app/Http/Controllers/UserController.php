<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;

use App\User;
use App\Role;
use App\Department;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('admain',['except'=>array('showProfile','updateProfile','userPhoto','taskTeam')]);
    }

    public function index()
    {
        return view('usersRole')->with([
            'users' => User::all()
        ]);
    }


   
    //create new user by admain 
    public function store(Request $request)
    {
       
        $this->validate( $request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => 'required',
            'Departments' => 'required',

        ]);
       
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => $request->get('role'),
            'dep_id' => $request->get('Departments'),
        ]);
        

        return redirect('users')
        ->with('success','User created successfully.');
    }

    
    public function showProfile( $id)
    {   
        $user=User::with(['role','department'])->findOrFail($id);
       
        return view('profile')->with(['user'=>$user]) ;
    }

    public function updateProfile(Request $request,$id){
        $authrized_user_id=  auth()->user()->id;
        $user =User::with(['role','department'])->findOrFail($id);

       if($id ==  $authrized_user_id ){
        $user->update([
             'name' => $request['name'],
             'first_name' => $request['first_name'],
             'last_name' => $request['last_name'],
             'email' => $request['email'],
             'password' => Hash::make($request['password']),
            ]);

           if ($request->expectsJson()) {
                return response()->json([
                 'message' => 'Your profile info Updated successfully',
                 $user,
             ]);
         }   
         return redirect()->back()
         ->with('success','Your profile info Updated successfully.');
       }
        else
        return redirect()->back()
         ->withErrors('wrong','unauthrize to update');       
    }

    public function userPhoto(Request $request,$id){
        // dd($request->all());
        $this->validate($request,[
            'photo'=>'sometimes|mimes:png,jpeg,jpg|max:20000'
        ]);
        
        $authrized_user_id=  auth()->user()->id;
        $user =User::findOrFail($id);
        if($request->hasfile('photo')){
            $file=$request->file('photo');
            //to save file as orgenal extention like png , jpg , and other
            $ext= $file->getClientOriginalExtension();
            //to save name of file as 12345.png for ex
            $filename= time().'.'.$ext;
             // Define upload path
             $destinationPath = public_path('/uploads/avatar/'); // upload path
           
            //create folder in bublic directry and then upload the file inside it
            $file->move($destinationPath, $filename);

            if($id ==  $authrized_user_id ){
                $user->update([
                     'photo' => $filename,
                    ]);
                 return redirect()->back()
                 ->with('success','Your avatar Updated successfully.');
               }
                else
                return redirect()->back()
                 ->withErrors('wrong','unauthrize to update');
        }  
    }
   
    public function edit(User $user)
    {
        //
    }
// update user info by admain
    public function update(Request $request,  $id)
    {
        // dd($request->all());
        $user =User::findOrFail($id);
        $this->validate( $request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['sometimes', 'string', 'min:8'],
            'role' => 'required',
            'Departments' => 'required',

        ]);
       
       $user->update(  
           [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => $request->get('role'),
            'dep_id' => $request->get('Departments'),
        ]
    );
        return redirect('users')
        ->with('success','User Updated successfully.');
    }
// delete user by admain
    public function destroy($id)
    {
        $user =User::findOrFail($id);
        $user->delete();
        return  redirect()->back()
        ->with('success','User deleted successfully.');

    }
// fitter user by admain
    public function filterUsers(Request $request){
        $userRole = Role::all();
        $Pdep = Department::all();
        //get selected type id from form
        $role=$request->get('role');
        //get the selected Department id from form
        $department=$request->get('Departments');
        if($role ||  $department){
            $users= User::with(['role','department'])
            ->where('role_id',$role )
            ->orWhere('dep_id',$department)
            ->paginate(10);
            return view('usersRole')->with([
                'roles'=>$userRole,
                'departments'=> $Pdep,
                'users'=> $users,
            ]);
        }
        else{
            $users= User::with(['role','department']) 
            ->paginate(10);
            return view('usersRole')->with([
                'roles'=>$userRole,
                'departments'=> $Pdep,
                'users'=> $users,
            ]);
        }
    }

// to show  all manager name in dropdown list to assign project 
    public function manager()
    {
        $managers = User::all()->where('role_id', 4);
        return view('managerV', compact('managers'));
    }

//to show all user how will assign to task in muliteselect
    public function taskTeam()
    {
        $teams = User::all()->where('role_id', 1);
        return view('teamV', compact('teams'));
    }
   
}
