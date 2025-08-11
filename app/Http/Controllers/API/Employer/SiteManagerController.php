<?php

namespace App\Http\Controllers\API\Employer;

use App\Http\Controllers\Controller;
use App\Models\SiteManager;
use Illuminate\Http\Request;

class SiteManagerController extends Controller
{
    public function pySiteManagerList(){
        $employee = SiteManager::select('id','selfie')->get();
        return $this->success(true, 'SiteManager get successfully.',$employee);
    }
}
