<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enableAddress = false;
        $children=Child::paginate(5);
        return view('children.index' ,compact('children','enableAddress'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|regex:/^[a-zA-Z ]+$/',
            'middlename' => 'nullable|regex:/^[a-zA-Z ]+$/',
            'lastname' => 'required|regex:/^[a-zA-Z ]+$/',
            'age' => 'required|numeric|min:1|max:100',
            'gender' => 'required|in:male,female,other',
            'address' => 'nullable|regex:/^[a-zA-Z0-9 ]+$/',
            'city' => 'nullable|regex:/^[a-zA-Z ]+$/',
            'state' => 'nullable|regex:/^[a-zA-Z]+$/',
            'country' => 'nullable|regex:/^[a-zA-Z ]+$/',
            'zipcode' => 'nullable|numeric'
        ]);
        
        
        
        $child = new Child;
        $child->firstname = $validatedData['firstname'];
        $child->middlename = $validatedData['middlename'];
        $child->lastname = $validatedData['lastname'];
        $child->age = $validatedData['age'];
        $child->gender = $validatedData['gender'];

        if (array_key_exists('address', $validatedData)) {
            $child->address = $validatedData['address'];
        }
        
        if (array_key_exists('city', $validatedData)) {
            $child->city = $validatedData['city'];
        }
        
        if (array_key_exists('state', $validatedData)) {
            $child->state = $validatedData['state'];
        }
        
        if (array_key_exists('country', $validatedData)) {
            $child->country = $validatedData['country'];
        }
        
        if (array_key_exists('zipcode', $validatedData)) {
            $child->zipcode = $validatedData['zipcode'];
        }

        $child->save();
    
 return redirect()->route('children.index')->with('success', 'Child created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Child $child)
    {
        $child->delete();
        return redirect()->route('children.index',compact('child'))->with('successdelete', 'Child deleted successfully.');
    }
 
}
