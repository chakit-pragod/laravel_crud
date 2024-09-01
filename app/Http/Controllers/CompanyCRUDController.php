<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyCRUDController extends Controller
{
    // Create Index
    public function index(){
        $data['companies'] = Company::orderBy('id', 'asc')->paginate(5);
        return view('companies.index', $data);
    }

    // Create resource

    public function create(){
        return view('companies.create');
    }

    // Store resource
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        // ส่งข้อมูลกลับไปที่หน้า index และแสดงข้อความตามที่กำหนด
        return redirect()->route('companies.index')->with('success', 'Company has been created successfully.');
    }
}
