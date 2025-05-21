<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsModel extends Model
{
    //
    use HasFactory;

    protected $table = 'contact_us';
    protected $primaryKey = 'id';

    protected $fillable = ['first_name','last_name','email','subject','message','status','read','seen_by','seen_at','created_at','updated_at','uuid'];
}
