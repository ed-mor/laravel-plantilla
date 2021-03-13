<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function index()
    {
        //$user = Auth::user();
        return Inertia::render('Users/index', [
            'filters' => Request::all('buscar', 'status', 'eliminados'),
            'users' => Auth::user()->account->users()
                ->orderByStatus()
                ->orderByName()                
                ->filter(Request::only('buscar', 'status', 'eliminados'))
                ->latest()
                ->get()
                ->transform(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'status' => $user->status,
                        'profile_photo_path' => $user->photoUrl(),
                        //'photo' => $user->profile_photo_path,
                        'deleted_at' => $user->deleted_at,
                    ];
                }),
            'sessionAccount' => Auth::user()->account->name
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create', [
            'sessionAccount' => Auth::user()->account->name
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        Auth::user()->account->users()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);

        return Redirect::route('users')->with('success', 'Usuario creado satisfactoriamente...');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user_a' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'profile_photo_path' => $user->photoUrl(),
                'deleted_at' => $user->setFecha(),
                'account_id' => $user->account_id,
                'account_name' => Auth::user()->account->name,
            ],
            'sessionAccount'    => Auth::user()->account->name,
            'accounts' => Account::select('id', 'name')->orderBy('name', 'ASC')->get()
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        //  Si es DEMO Cancela
        if (config('system.app_isDemo')) {
           return Redirect::back()->with('error', 'La actualización no está permitida en la versión DEMO');
        }
        //  Asignando valores
            $user->account_id = $request['account_id'];
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->status = $request['status'];
        //  Si el usuario sube una nueva imagen
        if ($request->file('profile_photo_path')) {
            //  Eliminamos la imagen anterior
            $imgOld = 'public/' . $user->profile_photo_path;
            Storage::delete($imgOld);
            //  Obtenemos la ruta de la nueva imagen
            $ruta_imagen = $request['profile_photo_path']->store('profile-photos','public');
            //  Actualizamos el string de la imagen para la BBDD
            $user->profile_photo_path = $ruta_imagen;
            //  Guardamos la nueva imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(300,300);
            $img->save();
        }
        //  Salvamos
        $user->save();
        // Si Hay password nuevo lo actualizo.
        if ($request->get('password')) {
            $user->update(['password' => $request->get('password')]);
        }

        //  Redireccionar con un mensaje flash que muestra Sweet Alert
        return Redirect::back()->with('success', 'Usuario actualizado con éxito...');
    }

    public function deletePhoto(User $user)
    {
        if (config('system.app_isDemo')) {
            return Redirect::back()->with('error', 'La Eliminación, no es permitida en la versión DEMO...');
        }
        //  Eliminamos la foto 
        $imgOld = 'public/' . $user->profile_photo_path;
        if(Storage::delete($imgOld)){
            $user->profile_photo_path = null;
            $user->save();
            //  Redireccionar
            return Redirect::back()->with('success', 'Foto Eliminada...');
        }else{
            return Redirect::back()->with('error', 'Usuario sin foto...');
        }
    }

    public function destroy(User $user)
    {
        if (config('system.app_isDemo')) {
            return Redirect::back()->with('error', 'La Eliminación de Usuarios, no es permitida en la versión DEMO...');
        }
        //  Eliminamos la foto 
        //  $imgOld = 'public/' . $user->profile_photo_path;
        //  Storage::delete($imgOld);
        
        $user->delete();
        return Redirect::route('users')->with('success', 'Usuario eliminado...');
        //  return Redirect::back()->with('success', 'Usuario eliminado...');
    }

    public function forceDelete(User $user)
    {
         // Eliminamos la foto 
         $imgOld = 'public/' . $user->profile_photo_path;
         Storage::delete($imgOld);
         $user->forceDelete();
         return Redirect::route('users')->with('success', 'Usuario eliminado...');
    }

    public function restore(User $user)
    {
        $user->restore();
        return Redirect::back()->with('success', 'Usuario restaurado...');
    }

}

