<?php

namespace App\Http\Controllers;

use App\emailContact;
use Illuminate\Http\Request;
use Mail;

class EmailContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactUs()
    {
        return view('bursary.emailvalidation');
    }

    public function contactUSPost(Request $request)
   {
       $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required'
        ]);

       ContactUS::create($request->all());

       return back()->with('success', 'Thanks for contacting us!');
   }
}


    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }
    //
    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }
    //
    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\emailContact  $emailContact
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(emailContact $emailContact)
    // {
    //     //
    // }
    //
    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\emailContact  $emailContact
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(emailContact $emailContact)
    // {
    //     //
    // }
    //
    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\emailContact  $emailContact
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, emailContact $emailContact)
    // {
    //     //
    // }
    //
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\emailContact  $emailContact
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(emailContact $emailContact)
    // {
    //     //
    // }
// }
