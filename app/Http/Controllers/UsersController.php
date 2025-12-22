<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessUploadedUserAvatar;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use JetBrains\PhpStorm\NoReturn;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(6)->load('permissions');
        $users_link = User::paginate(6);
        $permissions = Permission::all();
        return Inertia::render('Users', [
            'volunteers' => $users,
            'permissions' => $permissions,
            'volunteers_link' => $users_link
        ]);
    }

    public function create()
    {
    }

    #[NoReturn]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'avatar' => 'image|mimes:jpg,png,gif',
            'name' => 'required|min:3',
            'email' => 'email|required|unique:users',
            'tel' => 'required',
            'schedule' => 'array',
            'schedule.*' => 'array',
            'schedule.*.*' => 'bool'
        ]);

        $validated['schedule'] = json_encode($validated['schedule']);

        $avatar = $validated['avatar'];
        $new_images = [];

        if ($avatar) {
            $new_original_file_name = uniqid() . '.' . config('avatar.image_type');
            $full_path_to_original = Storage::putFileAs(
                config('avatar.original_path'),
                $avatar,
                $new_original_file_name
            );
            if ($full_path_to_original) {
                $avatar = $new_original_file_name;
                ProcessUploadedUserAvatar::dispatch($full_path_to_original, $new_original_file_name);
            } else {
                $avatar = '';
            }
            $avatar = $full_path_to_original;
            $new_images[$avatar] = $avatar;
        }
        $validated['avatar'] = collect($new_images);

        $validated['avatar'] = $validated['avatar']->first();
        $validated['password'] = 'password';

        $user = User::create($validated);

        $permissions = $request['permissions'];

        $user->permissions()->attach($permissions);

        return back();
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
