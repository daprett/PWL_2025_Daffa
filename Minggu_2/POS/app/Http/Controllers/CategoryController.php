<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function foodbeverage(){
        return view('Product.foodbeverage');
    }

    public function beautyhealth(){
        return view('Product.beautyhealth');
    }

    public function homecare(){
        return view('Product.homecare');
    }

    public function babykid(){
        return view('Product.babykid');
    }

}
