<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'email',
        'email_verified_at',
        'password',
        'status',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'uuid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public final static function saveLoggedInAt($user_id,$details){
        $browser            =   Agent::browser();
        $version            =   Agent::version($browser);
        $platform           =   Agent::platform();
        $versionPlatform    =   Agent::version($platform);
        $userIP             =   $_SERVER['REMOTE_ADDR'];
        $arrayData          =   ['user_id'=>$user_id,'details'=>$details,'user_platform'=>$platform.' '.$versionPlatform,'user_browser'=>$browser.' '.$version,'user_ipaddress'=>$userIP,'issued_at'=>now()];

        $results = DB::table('user_logs')->insertGetId($arrayData);
        if($results){
            session(['last_logged_in_id'=>$results]);
        }
    }
}
