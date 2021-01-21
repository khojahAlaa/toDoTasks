<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    
    public function index()
    {
        return view('departments')->with([
            'departments' => Department::all()
        ]);
    }

    
    public function create()
    {
        return view('createDepartment');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'dep_name' => 'required',
        ]);
        $department= new Department();
        $department->name = $request->get('dep_name');
        $department->save();
        return redirect('department');
    }

   
    public function show($id)
    {
        return view('departments')->with([
            'department' => Department::findOrFail($id)
        ]);
    }


}
