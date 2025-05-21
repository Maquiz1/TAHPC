<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TopNavbarModel extends Model {
    //
    use HasFactory;

    protected $table = 'top_navbar';
    protected $primaryKey = 'id';
    protected $fillable = ['position','data','status','created_at','updated_at','created_by','updated_by','uuid'];

    public static function topNavbarCallBack(){
        $data = DB::table('top_navbar')->select('*')
            ->where('status','=','active')
            ->get();
        $section = 'top_navbar';

        return view('partials.general-partials',compact('data','section'))->render();
    }
}
