<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Traits\StatusTrait;

class AdminUserController extends Controller
{
    use StatusTrait;

    public function index(): View
    {
        $this->authorize('access-user-page');

        return view('admin.user.index', [
            'users' => User::query()
                ->select(['id', 'name', 'email', 'image', 'status',])
                ->where('user_type', '!=', UserType::Admin->value)
                ->latest()
                ->get()
        ]);
    }

    public function create(): View
    {
        $this->authorize('add-user');

        return view('admin.user.create', [
            'roles' => Role::select(['id', 'title'])->pluck('title', 'id'),
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $data = $request->safe()->except('image', 'permissions');
            $data['user_type'] = UserType::Staff->value;

            $user = User::create($data);

            $user->permissions()->attach($request->permissions);

            if ($request->hasFile('image')) {
                $user->storeImage('image', 'profile-images', $request->file('image'));
            }

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User Created Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(User $user): View
    {
        $this->authorize('access-user-page');

        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user): View
    {
        $this->authorize('edit-user');

        $user->load('permissions:id,title');
        $userRole = Role::with('permissions:id,title')->select(['id', 'title'])->where('id', $user->role_id)->first();

        return view('admin.user.edit', [
            'user' => $user,
            'roles' => Role::select(['id', 'title'])->pluck('title', 'id'),
            'rolePermissions' => $userRole?->permissions,
            'userPermissions' => $user->permissions->pluck('id')->toArray(),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->safe()->except(['new_password', 'confirm_password', 'current_password', 'image', 'permissions']);

            if ($request->new_password) {
                $currentPasswordStatus = Hash::check($request->current_password, $user->password);

                if (!$currentPasswordStatus) {
                    return redirect()->route('admin.users.index')->with('error', 'Current password does not match');
                }

                $data['password'] = Hash::make($request->new_password);
            }

            if ($request->hasFile('image')) {
                $user->updateImage('image', 'profile-images', $request->file('image'));
            }

            $user->update($data);

            $user->permissions()->sync($request->permissions);
            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete-user');

        if ($user->image) {
            $user->deleteImage('image', 'profile-images');
        }

        $user->permissions()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')->with('error', 'User Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('User', $request->id, $request->status);
    }
}
