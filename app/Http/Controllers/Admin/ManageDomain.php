<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;

class ManageDomain extends Controller
{
    public function index(string $id)
    {
        $domain = Domain::find($id);
        return view('admin.domains.manageDomain',['domain'=>$domain]);
    }
}
