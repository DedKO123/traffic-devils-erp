<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(public UserService $userService)
    {
    }

    public function index(Request $request): View
    {
        return view('users.index', [
            'users' => $this->userService->getWithPagination(10, $search = $request->filled('search') ? $request->search : null),
        ]);
    }

    public function create(): View
    {
        if (auth()->user()->cannot('manage user', User::class)) {
            abort(403);
        }
        $mentors = $this->userService->getMentors();
        return view('users.create', [
            'mentors' => $mentors,
        ]);
    }

    public function store(Request $request)
    {
        if (auth()->user()->cannot('manage user', User::class)) {
            abort(403);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'mentor_id' => 'nullable|exists:users,id',
            'role' => 'required|string|exists:roles,name',
        ]);
        try {
            $userDTO = UserDTO::fromRequest($request->all());
            $this->userService->create($userDTO);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        if (auth()->user()->cannot('manage user', User::class)) {
            abort(403);
        }
        $mentors = $this->userService->getMentors();
        return view('users.edit', [
            'user' => $user,
            'mentors' => $mentors,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'mentor_id' => 'nullable|exists:users,id',
            'role' => 'required|string|exists:roles,name',
        ]);
        try{
            $userDTO = UserDTO::fromRequest($request->all());
            $this->userService->update($user, $userDTO);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        try {
            $this->userService->delete($user);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
