<?php



namespace App\Http\Controllers\Admin\SiteManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteManager;

class SiteManagerController extends Controller
{
    public function index($employer_id)
    {
        $siteManagers = SiteManager::where('site_id', $employer_id)->get();
        return view('admin.view.siteManager.index', compact('siteManagers', 'employer_id'));
    }
}
