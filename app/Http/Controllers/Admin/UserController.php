<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', User::class);

        $users = User::query()
            ->orderBy('name')
            ->get();

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', User::class);

        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        /** @var User $user */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => $data['password'],
        ]);

        return redirect()
            ->route('admin.users.edit', $user)
            ->with('status', __('User created successfully.'));
    }

    public function edit(User $user): View
    {
        $this->authorize('update', $user);

        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->save();

        return redirect()
            ->route('admin.users.edit', $user)
            ->with('status', __('User updated successfully.'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', $user);

        if ($user->isGlobalAdmin()) {
            $otherAdmins = User::query()
                ->where('id', '!=', $user->id)
                ->where('role', User::ROLE_GLOBAL_ADMIN)
                ->count();

            if ($otherAdmins === 0) {
                return redirect()
                    ->route('admin.users.index')
                    ->with('status', __('You cannot delete the last Global Admin.'));
            }
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('status', __('User deleted.'));
    }
}

