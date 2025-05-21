<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('app:load_default_user',function(){
    function loadDefaultUser($output):void {
        //check if user already created
        $users = User::query()->select('*')->where('email','=','superuser@gmail.com')
            ->count();
        if ($users <= 0) {
            $userData = [
              'first_name'=>'super',
              'middle_name'=>'user',
              'last_name'=>'super',
              'gender'=>'male',
              'email'=>'superuser@gmail.com',
              'password'=>Hash::make('superuser'),
              'created_at'=>Carbon::now(),
              'created_by'=>1,
              'uuid'=>Str::uuid(),
            ];
            $userQuery = new User();
            $userQuery->fill($userData);
            if ($userQuery->save()) {
                $output->line('default user created successfully.');
            }else{
                $output->line('failed to create default user.');
            }
        }else{
            $output->line('default user already exists.');
        }
    }

    loadDefaultUser($this);
});
