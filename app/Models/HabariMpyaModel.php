<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HabariMpyaModel extends Model
{
    //
    use HasFactory;

    protected $table = 'habari_mpya';
    protected $primaryKey = 'id';
    protected $fillable = ['category','title','short_description','body','created_at','updated_at','published_at','created_by','status','updated_by',
        'title_p','full_name','uuid'];


    public static function contentSectionCallBack(){
        $data = DB::table('habari_mpya')->select('*')
            ->where('status','=','active')
            ->orderBy('id','DESC')
            ->get();
        $section = 'content_section';

        return view('partials.general-partials',compact('data','section'))->render();
    }
}
