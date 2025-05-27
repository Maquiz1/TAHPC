<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactUsModel extends Model
{
    //
    use HasFactory;

    protected $table = 'contact_us';
    protected $primaryKey = 'id';

    protected $fillable = ['first_name','last_name','email','subject','message','status','read','seen_by','seen_at','created_at','updated_at','uuid'];


    public static function contentSectionCallBack()
    {
        $data = DB::table('contact_us')->select('*')
            ->where('status', '=', 'active')
            ->orderBy('id', 'DESC')
            ->get();
        $section = 'contact_us';

        return view('partials.general-partials', compact('data', 'section'))->render();
    }

    public static function readFeedBack($elementKey){
        $data = DB::table('contact_us')->select('*')
            ->where('status', '=', 'active')
            ->where('uuid', '=', $elementKey)
            ->get();
        $section = 'read_feedback_section';

        DB::table('contact_us')->where('uuid','=',$elementKey)->update(['read'=>'seen', 'seen_by'=>Auth::user()->id, 'seen_at'=>now()]);
        return view('partials.general-partials', compact('data', 'section'))->render();
    }

}
