<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $c = new Category();
        $c->title = 'title';
        $c->save();
        return view('admin.index');
    }
}
