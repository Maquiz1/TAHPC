<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //function that returns the users management page
    public function index(Request $request)
    {
        return view('admin.users');
    }

    //function that returns the users table rows
    public function usersCallBack(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->get();
        return view('partials.users-rows', compact('data'))->render();
    }

    //function that creates a new user
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'first_name'  => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name'   => 'required|string|max:100',
            'gender'      => ['required', Rule::in(['male', 'female'])],
            'email'       => 'required|email|max:191|unique:users,email',
            'phone'       => ['nullable', 'regex:/^[0-9]{10}$/', 'unique:users,phone'],
            'role'        => ['required', Rule::in(['admin', 'editor'])],
            'password'    => 'required|string|min:8|confirmed',
        ], [
            'phone.regex' => 'Phone number must be exactly ten digits.',
        ]);

        if ($validator->fails()) {
            return $this->respond(['error' => $validator->errors()->first()]);
        }

        $user = new User();
        $user->fill([
            'first_name'  => ucwords(strtolower($request->input('first_name'))),
            'middle_name' => $request->filled('middle_name') ? ucwords(strtolower($request->input('middle_name'))) : null,
            'last_name'   => ucwords(strtolower($request->input('last_name'))),
            'gender'      => $request->input('gender'),
            'email'       => strtolower($request->input('email')),
            'phone'       => $request->input('phone') ?: null,
            'role'        => $request->input('role'),
            'password'    => $request->input('password'),
            'status'      => 'active',
            'created_by'  => Auth::id(),
            'uuid'        => (string) Str::uuid(),
        ]);

        if ($user->save()) {
            return $this->respond(['success' => 'User created successfully!']);
        }
        return $this->respond(['error' => 'Something went wrong, failed to create user. Try again!']);
    }

    //function that activates / deactivates a user
    public function toggleStatus(Request $request)
    {
        $user = $this->findOtherUser($request);
        if (is_array($user)) {
            return $this->respond($user);
        }

        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->updated_by = Auth::id();
        $user->save();

        // Sign out a deactivated user immediately instead of at session expiry.
        if ($user->status === 'inactive') {
            DB::table('sessions')->where('user_id', $user->id)->delete();
        }

        return $this->respond(['success' => 'User is now ' . $user->status . '.']);
    }

    //function that switches a user between admin and editor
    public function toggleRole(Request $request)
    {
        $user = $this->findOtherUser($request);
        if (is_array($user)) {
            return $this->respond($user);
        }

        $user->role = $user->role === 'admin' ? 'editor' : 'admin';
        $user->updated_by = Auth::id();
        $user->save();

        return $this->respond(['success' => 'User is now ' . $user->role . '.']);
    }

    //function that sets a new password for a user
    public function resetPassword(Request $request)
    {
        $user = $this->findOtherUser($request);
        if (is_array($user)) {
            return $this->respond($user);
        }

        $validator = validator($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return $this->respond(['error' => $validator->errors()->first()]);
        }

        $user->password = $request->input('password');
        $user->updated_by = Auth::id();
        $user->save();

        DB::table('sessions')->where('user_id', $user->id)->delete();

        return $this->respond(['success' => 'Password updated successfully!']);
    }

    //finds the target user by uuid; admins may not change their own account here
    private function findOtherUser(Request $request)
    {
        $user = User::where('uuid', $request->input('uuid'))->first();
        if (! $user) {
            return ['error' => 'User not found.'];
        }
        if ($user->id === Auth::id()) {
            return ['error' => 'You cannot change your own account from here.'];
        }
        return $user;
    }

    private function respond(array $data)
    {
        return response(json_encode($data))->header('Content-Type', 'text/html');
    }
}
