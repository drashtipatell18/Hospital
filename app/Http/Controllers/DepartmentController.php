<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function department()
    {
        $departments = Department::all();
        return view('department.view_department',compact('departments'));
    }

    public function departmentCreate(Request $request){
        return view('department.create_department');
    }

    public function departmentInsert(Request $request){
        Department::create([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status')
        ]);

        session()->flash('success', 'Department added successfully!');
        return redirect()->route('department');
    }

    public function departmentEdit(Request $request, $id){
        $departments = Department::find($id);
        return view('department.create_department', compact('departments'));
    }

    public function departmentUpdate(Request $request, $id){
        $departments = Department::find($id);
        $departments->update([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status')
        ]);

        session()->flash('success', 'Department Updated successfully!');
        return redirect()->route('department');
    }

    public function departmentDelete($id){
        $departments = Department::find($id);
        $departments->delete();
        session()->flash('danger', 'Department Delete successfully!');
        return redirect()->back();
    }
}
