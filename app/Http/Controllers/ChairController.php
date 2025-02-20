<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleRequest;

class ChairController extends Controller
{
    private function loadView($activeSection)
    {
        return view('chair.index', compact('activeSection'));
    }

    public function index()
    {
        return $this->loadView('reviewCriteria');
    }

    public function assignAbstracts()
    {
        return $this->loadView('assignAbstracts');
    }

    public function reviewCriteria()
    {
        return $this->loadView('reviewCriteria');
    }
}