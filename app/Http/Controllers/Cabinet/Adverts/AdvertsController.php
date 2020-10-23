<?php

namespace App\Http\Controllers\Cabinet\Adverts;

use App\Http\Middleware\FilledProfile;

class AdvertsController extends \App\Http\Controllers\Controller
{

    public function index()
    {
        return view('cabinet.adverts.index');
    }

    public function create()
    {
        return view('cabinet.adverts.create');
    }

    public function edit()
    {
        return view('cabinet.adverts.edit');
    }
}
