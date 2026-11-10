<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user interactively (works on an empty database too)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $firstName = $this->ask('First name');
        $middleName = $this->ask('Middle name (optional)');
        $lastName = $this->ask('Last name');
        $gender = $this->choice('Gender', ['male', 'female'], 0);
        $email = strtolower((string) $this->ask('Email'));
        $password = $this->secret('Password (min 8 characters)');
        $confirm = $this->secret('Confirm password');

        $validator = validator(compact('firstName', 'lastName', 'email', 'password'), [
            'firstName' => 'required|string|max:100',
            'lastName'  => 'required|string|max:100',
            'email'     => 'required|email|max:191|unique:users,email',
            'password'  => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            $this->error($validator->errors()->first());
            return self::FAILURE;
        }
        if ($password !== $confirm) {
            $this->error('Passwords do not match.');
            return self::FAILURE;
        }

        $attributes = [
            'first_name'  => ucwords(strtolower($firstName)),
            'middle_name' => $middleName ? ucwords(strtolower($middleName)) : null,
            'last_name'   => ucwords(strtolower($lastName)),
            'gender'      => $gender,
            'email'       => $email,
            'password'    => $password,
            'status'      => 'active',
            'role'        => 'admin',
            'uuid'        => (string) Str::uuid(),
        ];

        $existingAdmin = User::where('role', 'admin')->orderBy('id')->first();

        if ($existingAdmin) {
            $user = User::create($attributes + ['created_by' => $existingAdmin->id]);
        } else {
            // created_by must reference an existing user, so the very first
            // user is inserted with checks off and then points to itself.
            $user = DB::transaction(function () use ($attributes) {
                Schema::disableForeignKeyConstraints();
                try {
                    $user = User::create($attributes + ['created_by' => 0]);
                    $user->created_by = $user->id;
                    $user->save();
                } finally {
                    Schema::enableForeignKeyConstraints();
                }
                return $user;
            });
        }

        $this->info("Admin {$user->email} created. They can now log in and add other users from the Users page.");
        return self::SUCCESS;
    }
}
