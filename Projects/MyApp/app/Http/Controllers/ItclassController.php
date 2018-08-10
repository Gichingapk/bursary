<?php

namespace App\Http\Controllers;

use App\Itclass;
use Illuminate\Http\Request;

class ItclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = new Itclass();
        $students = $students::all();

        return view('index',compact('students'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store the student details entered in the form
        $itclass = new Itclass();
        $itclass->usernames = $request->username;
        $itclass->regno = $request->regno;

        $itclass->save();



        return redirect()->route('itclass.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\itclass  $itclass
     * @return \Illuminate\Http\Response
     */
    public function show(itclass $itclass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\itclass  $itclass
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $student = new Itclass();

        $student = $student::find($id);

        return view('edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\itclass  $itclass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $student = new Itclass();

        $itstudent = $student::find($id);

        $itstudent->usernames = $request->username;
        $itstudent->regno = $request->regno;

        $itstudent->update();

        return redirect()->route('itclass.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\itclass  $itclass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $student = new Itclass();
        $student = $student::find($id);

        $student->delete();

        return redirect()->route('itclass.index');
    }
}
