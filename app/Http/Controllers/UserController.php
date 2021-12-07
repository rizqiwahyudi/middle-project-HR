<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
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
        $users              = User::all();
        $companiesCount     = Company::count();
        $departmentsCount   = Department::count();
        $employeesCount     = User::count();

        return view('admin.user.index', compact(
            'users', 
            'companiesCount',                            
            'departmentsCount', 
            'employeesCount',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies      = Company::all();
        $departments    = Department::all();
        return view('admin.user.create-user', compact('companies', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        
        $validatedData['password']      = Hash::make($validatedData['password']);
        $validatedData['company_id']    = $validatedData['company'];
        $validatedData['department_id'] = $validatedData['department'];

        User::create($validatedData);

        return redirect()->route('dashboard.admin')
                         ->with('success', 'User Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show-user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $companies      = Company::all();
        $departments    = Department::all();
        return view('admin.user.edit-user', compact([
            'companies', 
            'departments', 
            'user',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();
        
        $user->company_id       = $validatedData['company'];
        $user->department_id    = $validatedData['department'];

        $user->update($validatedData);

        return redirect()->route('dashboard.admin')
                         ->with('success', 'Data User Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        if ($user) {
            return redirect()->route('dashboard.admin')
                             ->with('success', 'Data User Berhasil Dihapus Sementara');
        } else {
            return redirect()->route('dashboard.admin')
                             ->with('error', 'Data User Gagal Dihapus!');
        }
    }

    public function getDeletedUsers()
    {
        $users = User::onlyTrashed()->get();

        return view('admin.user.deleted-user', compact('users'));
    }

    public function deletePermanent($id)
    {
        $user = User::onlyTrashed()->where('id', $id);
        $user->forceDelete();

        if ($user) {
            return redirect()->route('getDeletedUsers')
                             ->with('success', 'Data User Berhasil Dihapus Permanen');
        } else {
            return redirect()->route('getDeletedUsers')
                             ->with('error', 'Data User Gagal Dihapus!');
        }
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', $id);
        $user->restore();

        if ($user) {
            return redirect()->route('dashboard.admin')
                             ->with('success', 'Data User Berhasil Direstore');
        } else {
            return redirect()->route('getDeletedUsers')
                             ->with('error', 'Data User Gagal Direstore');
        }
    }

    public function restoreAll()
    {
        $users = User::onlyTrashed();
        $users->restore();

        if ($users) {
            return redirect()->route('dashboard.admin')
                             ->with('success', 'Data User Berhasil Direstore');
        } else {
            return redirect()->route('getDeletedUsers')
                             ->with('error', 'Data User Gagal Direstore');
        }   
    }

    public function deleteAll()
    {
        $users = User::onlyTrashed();
        $users->forceDelete();

        if ($users) {
            return redirect()->route('getDeletedUsers')
                             ->with('success', 'Data User Berhasil Dihapus Permanen');
        } else {
            return redirect()->route('getDeletedUsers')
                             ->with('error', 'Data User Gagal Dihapus!');
        }
    }
}
