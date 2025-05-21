<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SliderModel extends Model
{
    //
    use HasFactory;

    protected $table = 'slider_section';
    protected $primaryKey = 'id';
    protected $fillable = ['position','value','status','name','title','created_at','updated_at','created_by','updated_by','uuid'];

    public static function sliderSectionCallBack(){
        $data = DB::table('slider_section')->select('*')
            ->where('status','=','active')
            ->get();
        $section = 'slider_navbar';

        return view('partials.general-partials',compact('data','section'))->render();
    }
}
