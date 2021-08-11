<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
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
        $companies = Company::all();
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create-company');
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
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|max:255|unique:companies',
            'logo'    => 'required|image|mimes:jpeg,jpg,png,svg|max:2048|dimensions:min_width=100,min_height=100',
            'website_url' => 'required|url|unique:companies,website_url',
        ]);

        $company = $request->all();

        if ($request->file('logo')) {
            $logo               = $request->file('logo');
            $logo_name          = date('d-m-Y-H-i-s').'_'.$logo->hashName();
            $company['logo']    = $logo_name;

            $logo->storeAs('public/images', $logo_name);
        }

        Company::create($company);

        return redirect()->route('companies.index')
                         ->with('success', 'Company Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('admin.company.show-company', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit-company', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|max:255|'.Rule::unique('companies')->ignore($company->id),
            'logo'    => 'image|mimes:jpeg,jpg,png,svg|max:2048|dimensions:min_width=100,min_height=100',
            'website_url' => 'required|url|'.Rule::unique('companies')->ignore($company->id),
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            Storage::delete('public/images/'.$company->logo);

            $logo               = $request->file('logo');
            $logo_name          = date('d-m-Y-H-i-s').'_'.$logo->hashName();
            $data['logo']       = $logo_name;

            $logo->storeAs('public/images', $logo_name);
        }

        $company->update($data);

        return redirect()->route('companies.index')
                         ->with('success', 'Data Company Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $logo = $company->logo;

        $company->delete();

        if ($company) {
            return redirect()->route('companies.index')
                             ->with('success', 'Data Company Berhasil Dihapus Sementara');
        } else {
            return redirect()->route('companies.index')
                             ->with('error', 'Data Company Gagal Dihapus!');
        }
    }

    public function getDeletedCompanies()
    {
        $companies = Company::onlyTrashed()->get();

        return view('admin.company.deleted-company', compact('companies'));
    }

    public function restoreAll()
    {
        $companies = Company::onlyTrashed();
        $companies->restore();

        if ($companies) {
            return redirect()->route('companies.index')
                             ->with('success', 'Data Company Berhasil Direstore');
        } else {
            return redirect()->route('getDeletedCompanies')
                             ->with('error', 'Data Company Gagal Direstore');
        }   
    }

    public function deleteAll()
    {
        $companies  = Company::onlyTrashed()->get();
        $logos      = $companies->pluck('logo');

        foreach ($companies as $company) {
            $company->forceDelete();
        }

        if ($companies) {
            foreach ($logos as $logo) {
                Storage::delete('public/images/'.$logo);
            }
            return redirect()->route('getDeletedCompanies')
                             ->with('success', 'Data Company Berhasil Dihapus Permanen');
        } else {
            return redirect()->route('getDeletedCompanies')
                             ->with('error', 'Data Company Gagal Dihapus!');
        }
    }

    public function deletePermanent($id)
    {
        $company    = Company::onlyTrashed()->firstWhere('id', $id);
        $logo       = $company->logo;

        $company->forceDelete();

        if ($company) { 
            Storage::delete('public/images/'.$logo);
            return redirect()->route('getDeletedCompanies')
                             ->with('success', 'Data Company Berhasil Dihapus Permanen');
        } else {
            return redirect()->route('getDeletedCompanies')
                             ->with('error', 'Data Company Gagal Dihapus!');
        }
    }

    public function restore($id)
    {
        $company = Company::onlyTrashed()->where('id', $id);
        $company->restore();

        if ($company) {
            return redirect()->route('companies.index')
                             ->with('success', 'Data Company Berhasil Direstore');
        } else {
            return redirect()->route('getDeletedCompanies')
                             ->with('error', 'Data Company Gagal Direstore');
        }
    }
}
