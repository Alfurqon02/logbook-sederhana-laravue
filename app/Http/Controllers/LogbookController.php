<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use DateTime;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Logbook/Index', [
            'logbooks' => Logbook::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Logbook/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $date = new DateTime($request->date);

        // Format the date
        $formattedDate = $date->format('Y-m-d');
        // dd($formattedDate);
        $user_id = Auth::user()->id;

        Logbook::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $formattedDate,
            'user_id' => $user_id,
        ]);

        return redirect()->route('logbooks.index')->with('success', 'Logbook Created Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Logbook $logbook)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logbook $logbook)
    {
        return Inertia::render('Logbook/Edit', [
            'logbook' => $logbook,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logbook $logbook)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
        ])->validate();
        // $Logbook->$Logbook->id;
        $date = new DateTime($request->date);

        // Format the date
        $formattedDate = $date->format('Y-m-d');

        Logbook::find($logbook->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $formattedDate,
        ]);

        return redirect()->route('logbooks.index')->with('success', 'Logbook Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Logbook::find($id)->delete();
        return redirect()->route('logbooks.index')->with('success', 'Logbook Deleted Successfully');
    }
}
