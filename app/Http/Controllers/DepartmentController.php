<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $departments = Department::all();
        return view('admin.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create-department');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255|unique:departments,name',
            'description'   => 'required|string',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
                         ->with('success', 'Department Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('admin.department.edit-department', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name'          => 'required|string|max:255|'.Rule::unique('departments')->ignore($department->id),
            'description'   => 'required|string',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
                         ->with('success', 'Data Department Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        if ($department) {
            return redirect()->route('departments.index')
                             ->with('success', 'Data Department Berhasil Dihapus Sementara');
        } else {
            return redirect()->route('departments.index')
                             ->with('error', 'Data Department Gagal Dihapus!');
        }
    }

    public function getDeletedDepartments()
    {
        $departments = Department::onlyTrashed()->get();

        return view('admin.department.deleted-department', compact('departments'));
    }

    public function restoreAll()
    {
        $departments = Department::onlyTrashed();
        $departments->restore();

        if ($departments) {
            return redirect()->route('departments.index')
                             ->with('success', 'Data Department Berhasil Direstore');
        } else {
            return redirect()->route('getDeletedDepartments')
                             ->with('error', 'Data Department Gagal Direstore');
        }   
    }

    public function deleteAll()
    {
        $departments = Department::onlyTrashed();
        $departments->forceDelete();

        if ($departments) {
            return redirect()->route('getDeletedDepartments')
                             ->with('success', 'Data Department Berhasil Dihapus Permanen');
        } else {
            return redirect()->route('getDeletedDepartments')
                             ->with('error', 'Data Department Gagal Dihapus!');
        }
    }

    public function deletePermanent($id)
    {
        $department = Department::onlyTrashed()->where('id', $id);
        $department->forceDelete();

        if ($department) {
            return redirect()->route('getDeletedDepartments')
                             ->with('success', 'Data Department Berhasil Dihapus Permanen');
        } else {
            return redirect()->route('getDeletedDepartments')
                             ->with('error', 'Data Department Gagal Dihapus!');
        }
    }

    public function restore($id)
    {
        $department = Department::onlyTrashed()->where('id', $id);
        $department->restore();

        if ($department) {
            return redirect()->route('departments.index')
                             ->with('success', 'Data Department Berhasil Direstore');
        } else {
            return redirect()->route('getDeletedDepartments')
                             ->with('error', 'Data Department Gagal Direstore');
        }
    }


}
