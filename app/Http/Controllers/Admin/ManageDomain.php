<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\User;
use Illuminate\Http\Request;

class ManageDomain extends Controller
{
    public function index(string $id)
    {
        $domain = Domain::find($id);
        return view('admin.domains.manageDomain',['domain'=>$domain]);
    }

    public function customerList()
    {
        $user = User::join('company_infos','users.user_id','=','company_infos.user_id')->get();

        return view('admin.customers.customersList',['user'=>$user]);
    }
}
