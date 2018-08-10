<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class emailContact extends Model
{
  public $table = 'email_contacts';

  public $fillable = ['name','email','message'];
}
