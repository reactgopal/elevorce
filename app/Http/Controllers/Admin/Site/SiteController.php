<?php




namespace App\Http\Controllers\Admin\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use Illuminate\Support\Facades\File;

class SiteController extends Controller
{
    public function index($employer_id)
    {
        $sites = Site::with('employer')->where('employer_id', $employer_id)->get();
        return view('admin.view.site.index', compact('sites', 'employer_id'));
    }

    public function create($employer_id)
    {
        return view('admin.view.site.create', compact('employer_id')); // $id = employer_id
    }

    public function store(Request $request)
    {
        $email = Site::where('email', $request->email)->where('employer_id', $request->company_id)->first();
        if ($email) {
            return redirect()->back()->with('error', 'Email already exists.');
        }
        $phone = Site::where('phone', $request->phone)->where('employer_id', $request->company_id)->first();
        if ($phone) {
            return redirect()->back()->with('error', 'Number already exists.');
        }

        $input = [
            'employer_id' => $request->company_id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ];
        if ($request->hasFile('image')) {
            $imageName = time() . rand(1000, 9999) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/sites'), $imageName);
            $input['image'] = $imageName;
        }
        Site::create($input);
        return redirect(url('admin/site', $request->company_id))->with('success', 'Site created successfully.');
    }

    public function edit($id, $employer_id)
    {
        $site = Site::findOrFail($id);
        return view('admin.view.site.edit', compact('site', 'employer_id'));
    }

    public function update(Request $request, $id)
    {
        $email = Site::where('email', $request->email)->where('employer_id', $request->company_id)->where('id', '!=', $id)->first();
        if ($email) {
             return redirect()->back()->with('error', 'Email already exists.');
        }
        $phone = Site::where('phone', $request->phone)->where('employer_id', $request->company_id)->where('id', '!=', $id)->first();
        if ($phone) {
            return redirect()->back()->with('error', 'Number already exists.');
        }

        $site = Site::findOrFail($id);
        $input = [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ];
        if ($request->hasFile('image')) {
            $oldImagePath = public_path('images/sites/' . $site->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            $imageName = time() . rand(1000, 9999) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/sites'), $imageName);
            $input['image'] = $imageName;
        }
        Site::where('id', $id)->update($input);
        return redirect(url('admin/site', $request->company_id))->with('success', 'Site updated successfully.');
    }

    public function show($id , $employer_id)
    {
        $site = Site::findOrFail($id);
        return view('admin.view.site.show', compact('site', 'employer_id'));
    }

    public function destroy($id)
    {
        $site = Site::findOrFail($id);
        $oldImagePath = public_path('images/sites/' . $site->image);
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }
        $site->delete();

        return back()->with('success', 'Site deleted successfully.');
    }
}
