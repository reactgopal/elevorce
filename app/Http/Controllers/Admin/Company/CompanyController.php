<?php


namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index()
    {
        $data = User::get();
        return view('admin.view.company.index', compact('data'));
    }

    public function create()
    {
        return view('admin.view.company.create');
    }

    public function store(Request $request)
    {
        $email = User::where('email', $request->email)->first();
        if ($email) {
            return redirect()->back()->with('error', 'Email already exists.');
        }
        $number = User::where('number', $request->number)->first();
        if ($number) {
            return redirect()->back()->with('error', 'Number already exists.');
        }


        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
            'number' => $request->number,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
        ];


        if ($request->hasFile('image')) {
            $imageName = time() . rand(1000, 9999) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/employer'), $imageName);
            $input['image'] = $imageName;
        }

        if ($request->hasFile('company_logo')) {
            $imageName = time() . rand(1000, 9999) . '.' . $request->file('company_logo')->extension();
            $request->file('company_logo')->move(public_path('images/employer'), $imageName);
            $input['company_logo'] = $imageName;
        }

        if ($request->hasFile('company_cover_image')) {
            $imageName = time() . rand(1000, 9999) . '.' . $request->file('company_cover_image')->extension();
            $request->file('company_cover_image')->move(public_path('images/employer'), $imageName);
            $input['company_cover_image'] = $imageName;
        }

        User::create($input);

        return redirect()->route('company.index')->with('success', 'company created successfully.');
    }

    public function show($id)
    {
        $company = User::findOrFail($id);
        return view('admin.view.company.show', compact('company'));
    }

    public function edit($id)
    {
        $employer  = User::findOrFail($id);

        return view('admin.view.company.edit', compact('employer'));
    }

    public function update(Request $request, $id)
    {

        $email = User::where('email', $request->email)->where('id', '!=', $id)->first();
        if ($email) {
            return redirect()->back()->with('error', 'Email already exists.');
        }
        $number = User::where('number', $request->number)->where('id', '!=', $id)->first();
        if ($number) {
            return redirect()->back()->with('error', 'Number already exists.');
        }

        $user = User::findOrFail($id);

        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
        ];
        if ($request->has('password')) {
            $input['password'] = Hash::make($request->password);
        }

        foreach (['image', 'company_logo', 'company_cover_image'] as $field) {
            if ($request->hasFile($field)) {
                if (!empty($user->$field)) {
                    $oldImagePath = public_path('images/employer/' . $user->$field);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }
                $file = $request->file($field);
                $imageName = time() . rand(1000, 9999) . '.' . $file->extension();
                $file->move(public_path('images/employer'), $imageName);
                $input[$field] = $imageName;
            }
        }
        $user->update($input);
        return redirect()->route('company.index')->with('success', 'company updated successfully.');
    }

    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $imageFields = ['image', 'company_logo', 'company_cover_image'];

        foreach ($imageFields as $field) {
            $imagePath = public_path('images/employer/' . $user->$field);

            if ($user->$field && File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        User::destroy($id);
        return redirect()->route('company.index')->with('success', 'company deleted successfully.');
    }
}
