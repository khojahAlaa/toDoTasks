<?php

namespace App\Http\Controllers\API;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DepartmentResource;


class ApiDepartmentController extends Controller
{
    public $masterController;

    public function __construct(){
        $this->masterController = new DepartmentMasterController();
    }

    public function index()
    {
        return new DepartmentResource( $this->masterController->index() );
       
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show(Department $department)
    {
        //
    }

   
    public function update(Request $request, Department $department)
    {
        //
    }

    
    public function destroy(Department $department)
    {
        //
    }
}
