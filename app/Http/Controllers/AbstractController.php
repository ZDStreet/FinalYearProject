<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadAbstract;
use App\Models\ReviewCriteria;

class AbstractController extends Controller
{
    public function index()
    {
        $abstracts = UploadAbstract::with('user')->paginate(27);

        return view('abstracts.index', compact('abstracts'));
    }

    public function show($id)
    {
        $abstract = UploadAbstract::with('user')->findOrFail($id);

        return view('abstracts.show', compact('abstract'));
    }
}
