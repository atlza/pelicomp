<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use App\Traits\LogTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class Users extends Controller
{
    use Logtrait;

    public function users()
    {
        $users = User::all();
        $roles = Role::all()->pluck('name');

        return view('components/connected/users/users', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function edit(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'user_role' => 'required|string'
        ]);

        try {
            if( !auth()->user()->can('Manage admins') && in_array($request->user_role, ['super admin', 'admin']) ) {
                throw new \Exception('Droits insuffisants');
            }

            $editedUser = User::find($request->user_id);
            if( !auth()->user()->can('Manage admins') && $editedUser->hasRole(['admin', 'super admin']) ) {
                throw new \Exception('Droits insuffisants');
            }

            $editedUser->syncRoles($request->user_role);

            $this->log('update', 'user', $editedUser->id);
            return redirect()->route("manage-users")->with('message', trans('Droits ajustés'));
        } catch (\Exception $e) {
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }
}
