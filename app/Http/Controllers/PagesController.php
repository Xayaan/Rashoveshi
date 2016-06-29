<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function homepage(){

    	return view('rashoveshi.pages.home');
    }

    public function article(){
    	return view('rashoveshi.pages.article');
    }

    public function category(){
    	return view('rashoveshi.pages.category');
    }
    public function gallery(){
    	return view('rashoveshi.pages.gallery');
    }
    public function gallery_detail(){
        return view('rashoveshi.pages.gallery-detail');
    }
    public function results(){
        return view('rashoveshi.pages.results');
    }
    public function live(){
        return view('rashoveshi.pages.liveblog');
    }
    public function story(){
        return view('rashoveshi.pages.story');
    }
}
