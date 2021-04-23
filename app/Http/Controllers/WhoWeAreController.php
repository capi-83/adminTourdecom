<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WhoWeAreController extends Controller
{
    public function index ()
    {
      $programs = ['tuesday', 'wednesday', 'thursday', 'saturday'];

      return view('who-we-are', compact(
        'programs'
      ));
    }
}