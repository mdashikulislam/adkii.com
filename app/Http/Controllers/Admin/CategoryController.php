<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::withDepth()->find(12);
        return view('admin.categories.index');
    }

    public function create()
    {
        view()->share('fields',Category::getFromFields());
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $electronics = Category::create($request->except('_ token'));
        return 'done';
    }

}
