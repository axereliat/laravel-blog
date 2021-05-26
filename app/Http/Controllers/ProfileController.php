<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        return view('profile.index', ['user' => $user]);
    }

    public function update(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $user->name = $request->input('name');

        if ($request->hasFile('avatar')) {
            //dd($request->all());
            $path = $request->file('avatar')->store('avatars');

            $user->avatar = $path;
        }

        $user->save();

        return redirect()
            ->route('profile')
            ->with('success_message', 'Updated successfully.');
    }

    public function deleteAvatar(): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        if (file_exists($user->avatar)) {
            unlink($user->avatar);
        }

        $user->avatar = null;
        $user->save();

        return redirect()
            ->route('profile')
            ->with('success_message', 'Avatar removed successfully.');
    }
}
