<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dtos\UserDto;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private UserServiceContract $userService
    ) {
    }

    public function index(): View
    {
        return view('pages.user.index');
    }

    public function create(): View
    {
        return view('pages.user.create');
    }

    public function show(User $user): View
    {
        return view('pages.user.show', ['user' => $user]);
    }

    public function edit(User $user): View
    {
        return view('pages.user.edit', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $this->userService->delete($user->getKey());
    }

    //Currently using livewire
    public function store(UserRequest $request): JsonResponse
    {
        $userDto = new UserDto($request->validated());
        $this->userService->create($userDto);
        return response()->json([
            'success' => true
        ], JsonResponse::HTTP_CREATED);
    }

    //Currently using livewire
    public function update(UserRequest $request, User $user): JsonResponse
    {
        $userDto = new UserDto($request->validated());
        $this->userService->update($userDto, $user->getKey());
        return response()->json([
            'success' => true
        ]);
    }

    public function changeEmail(Request $request, string $token): RedirectResponse
    {
        if ($this->userService->setProcessEmail($token)) {
            Session::flash('alert-success', __('Process email change completed successfully.'));
        } else {
            Session::flash('alert-error', __('Process email change completed wrong.'));
        }

        return redirect()->route('users.index');
    }
}
