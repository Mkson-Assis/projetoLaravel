<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();

        $xss = '<script>alert("sou um hacker")</script>';

        return view('admin.supports.index', compact('supports', 'xss'));
    }

    public function create()
    {
        return view('admin.supports.create');
    }
}
