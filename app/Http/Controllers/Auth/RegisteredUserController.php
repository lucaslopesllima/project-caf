<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image'    => ['image','mimes:jpeg,png,jpg,gif,png']
        ]);

        $imagePath = '';

        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('public/images'); 
                $imageName = str_replace('public/', '', $imagePath);
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Erro ao fazer upload da imagem. Por favor, tente novamente.'])->withInput();
            }
        }

        DB::beginTransaction();

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'integrationHash' => Str::random(40),
                'profile_image_path'=>$imageName
            ]);

            DB::commit();

            return Redirect::route('profile.index')->with('status', 'user-created');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao criar usuário. Por favor, tente novamente.'])->withInput();
        }
    }
}
