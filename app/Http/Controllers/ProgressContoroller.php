<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressContoroller extends Controller
{
    public function index()
    {
        return Progress::all();
    }
}
