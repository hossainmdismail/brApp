<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Photo;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = Config::first();
        return view('backend.config.index', [
            'request' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.config.create_banner');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'number'    => 'required',
            'address'   => 'required',
            'logo'      => 'required',
            'url'       => 'required',
        ]);

        if (Config::count() != 0) {
            Config::truncate();
        }

        if ($request->logo) {
            Photo::upload($request->logo, 'files/config', 'CONFIG');
        }

        $config = new Config();
        $config->name       = $request->name;
        $config->email      = $request->email;
        $config->number     = $request->number;
        $config->url       = $request->url;
        $config->address    = $request->address;
        $config->logo       = $request->logo ? Photo::$name : 'null';
        $config->save();
        return back()->with('succ', 'Successfully configure');
    }

    /**
     * Display the specified resource.
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Config $config)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Config $config)
    {
        //
    }
}
