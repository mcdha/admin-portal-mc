<?php

namespace App\Http\Controllers;
use App\Models\Employees;
use App\Models\Companies;


use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::paginate(10); // Retrieve all employees from the database.
        $companies = Companies::all();
        return view('employees.index', compact('employees', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company_id' => 'required|exists:companies,id', // Ensure the company exists
        ]);

        $employee = Employees::create($request->all());
        $companyName = $employee->company->name;

        return redirect()->route('employees.index')
            ->with('success', "Employee created successfully for the company: $companyName.");
    }

    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        $employee = Employees::findOrFail($id);
        $companies = Companies::all();
        
        return view('employees.edit', compact('employee', 'companies'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company_id' => 'required|exists:companies,id', // Ensure the company exists
        ]);

        $employee = Employees::findOrFail($id);
        $employee->update($request->all());
        $companyName = $employee->company->name;

        return redirect()->route('employees.index')
            ->with('success', "Employee information updated successfully for the company: $companyName.");
    }


    
    public function destroy($id)
    {
        $employee = Employees::findOrFail($id);
        $companyName = $employee->company->name;
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', "Employee for the company: $companyName, deleted successfully.");
    }

}
