<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    public function index()
    {
        $user = null;
        if(Auth::check()){
            $user = Auth::user();
        };
        return view('info', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:5|max:255',
            'phone' => 'required|numeric',
            'avatar' => 'nullable|file|max:5000|mimes:png,jpg,webp',
        ]);

        $currentData = $user->only(['name', 'address', 'phone']);
        if ($request->hasFile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                $imagePath = Storage::disk('public')->put('user_images', $request->avatar);
                $validatedData['avatar'] = $imagePath;
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
            }
        } else {
            $validatedData['avatar'] = $user->avatar;
        }

        if ($currentData['name'] == $validatedData['name'] &&
            $currentData['address'] == $validatedData['address'] &&
            $currentData['phone'] == $validatedData['phone'] &&
            $user->avatar == $validatedData['avatar']) {
            return redirect()->back()->with('info', 'Cập nhật không có gì thay đổi');
        }

        $user->update($validatedData);

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }


}
