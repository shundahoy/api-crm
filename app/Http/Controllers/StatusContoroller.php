<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusContoroller extends Controller
{
    public function index()
    {
        return Status::all();
    }
}
