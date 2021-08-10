<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        $user = Auth::user();

        if ($user->role == 'admin') {

            $users              = User::all();
            $companiesCount     = Company::count();
            $departmentsCount   = Department::count();
            $employeesCount     = User::count();

            return view('admin.index', compact(
                'users', 
                'companiesCount',                            
                'departmentsCount', 
                'employeesCount',
            ));
        }
            
        return view('user.index');
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
        return view('admin.create-user', compact('companies', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'      => ['required', 'string', 'max:255', 'unique:users'],
            'first_name'    => ['required', 'string', 'max:100'],
            'last_name'     => ['required', 'string', 'max:100'],
            'telepon'       => ['required', 'numeric', 'digits_between:10,13', 'unique:users'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'company'       => ['required', 'not_in:0'],
            'department'    => ['required', 'not_in:0'],
            'role'          => ['required', 'not_in:0'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('create.user')
                             ->withErrors($validator)
                             ->withInput();
        }

        User::create([
            'username'      => $request['username'],
            'first_name'    => $request['first_name'],
            'last_name'     => $request['last_name'],
            'telepon'       => $request['telepon'],
            'email'         => $request['email'],
            'password'      => Hash::make($request['password']),
            'company_id'    => $request['company'],
            'department_id' => $request['department'],
            'role'          => $request['role'],
        ]);

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
        return view('admin.show-user', compact('user'));
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
        return view('admin.edit-user', compact([
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
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username'      => 'required|string|max:255'.Rule::unique('users')->ignore($user->id),
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'telepon'       => 'required|numeric|digits_between:10,13'.Rule::unique('users')->ignore($user->id),
            'email'         => 'required|string|email|max:255'.Rule::unique('users')->ignore($user->id),
            'company'       => 'required|not_in:0',
            'department'    => 'required|not_in:0',
            'role'          => 'required|not_in:0',
        ]);

        $user->company_id       = $request->company;
        $user->department_id    = $request->department;

        $user->update($request->all());

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
                             ->with('success', 'Data User Berhasil Dihapus');
        } else {
            return redirect()->route('dashboard.admin')
                             ->with('error', 'Data User Gagal Dihapus!');
        }
    }
}
