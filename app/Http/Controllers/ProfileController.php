<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(): View
    {
        return view('pages.profile.show', [
            'user' => Auth::user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('pages.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        Log::info($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;


        $avatar = $user->avatar;
        // التحقق من وجود الملف
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // التحقق مما إذا كان اسم الملف الجديد يطابق اسم الملف القديم
            if ($fileName !== $user->avatar) {
                // حذف الصورة القديمة إذا لزم الأمر
                if ($user->avatar && file_exists(public_path('avatar/' . $user->avatar))) {
                    unlink(public_path('avatar/' . $user->avatar));
                }

                // حفظ الصورة الجديدة
                $file->move(public_path('avatar'), $fileName);
                // تحديث اسم الملف في قاعدة البيانات
                $user->avatar = 'avatar/' . $fileName;
            }
        }


        $user->update();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
