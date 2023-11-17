<?php

namespace App\Http\Controllers;
use App\Models\Companies;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Companies::paginate(10); // Retrieve all companies from the database.
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create'); // Display the company creation form.
    }

   
    public function store(Request $request)
    {
        try {
            // Validate the input data.
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|unique:companies,email',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'website' => 'nullable|url',
            ]);

            // Handle logo upload.
            if ($request->hasFile('logo')) {
                $logoFile = $request->file('logo');
                
                $logoPath = $logoFile->storeAs('public', $logoFile->getClientOriginalName());
                $outputText = str_replace("public", "storage", $logoPath);
                $validatedData['logo'] =  $outputText;
            }
            
            Companies::create($validatedData);
            
            return redirect()->route('companies.index')->with('success', 'Company created successfully');
        } catch (\Exception $e) {
            return redirect()->route('companies.create')->with('error', 'An error occurred while creating the company. Please try again.');
        }
    }
   
    public function show(string $id)
    {
        //
    }

   
    public function edit($id)
    {
        $company = Companies::findOrFail($id); // Find the company by its ID
        return view('companies.edit', compact('company'));
    }

    
    public function update(Request $request, $id)
    {
        // Validate the input data.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $id,
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'website' => 'required|url',
        ]);

        // Handle logo upload if a new logo was provided.
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('/public');
            $validatedData['logo'] = $logoPath;
        }

        // Update the company in the database.
        Companies::where('id', $id)->update($validatedData);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    
    public function destroy($id)
    {
        $company = Companies::findOrFail($id);

        // Delete the company's logo if it exists in storage
        if ($company->logo) {
            Storage::delete($company->logo);
        }

        // Delete the company from the database
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }

}
