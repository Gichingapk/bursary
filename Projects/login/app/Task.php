<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  public function store(Request $request)
    {
    $this->validate($request, [
        'title' => 'required',
        'description' => 'required'
    ]);

    $input = $request->all();

    Task::create($input);

    Session::flash('flash_message', 'Task successfully added!');

    return redirect()->back();
    }

//song makena choir -- ukengi mwega wa jesu
}
