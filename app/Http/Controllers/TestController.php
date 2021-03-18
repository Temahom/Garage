<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index()
    {   
        $category = Category::with('products')->get();
    	return view()->exists('welcome2') ? view('welcome2',compact('category')) : '';
    }
}
