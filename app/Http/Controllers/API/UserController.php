<?php

namespace App\Http\Controllers\API;

use File;
use Error;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  User::latest()->paginate(10);
        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:200",
            "email" => "required|unique:users|max: 100",
            "password" => "required|string|min:4|max:100"
        ]);

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'bio' => $request['bio'],
            'type' => $request['type'],
            'photo' => $request['photo'] ?? 'profile.png',
        ]);
    }
    /**
     * Display the auth resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return new UserResource(auth('api')->user());
    }

    /**
     * update the auth resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        $currentPhoto = $user->photo;
        $request->validate([
            "name" => "required|string|max:200",
            "email" => "required|max:110|unique:users,email,".$user->id,
            "password" => "sometimes|required|string|min:4|max:100"
        ]);

        if($request->photo !== $currentPhoto){
            $extension = explode('/', mime_content_type($request->photo))[1];
            $name = uniqid(Str::slug($user->name) .'-').'.'.$extension;
            Image::make($request->photo)->resize(128,128)->save(public_path('img/profile/').$name);

            $request->merge(['photo' => $name]);

            // delete the old photo
            $photo_path = public_path('img/profile/') . $currentPhoto;
            if(file_exists($photo_path)){
               File::delete('img/profile/'. $currentPhoto);
            }
        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->all());

        return response()->json($user);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            "name" => "required|string|max:200",
            "email" => "required|max:110|unique:users,email,".$user->id,
            "password" => "sometimes|required|string|min:4|max:100"
        ]);

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update( $request->all() );
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // throw new Error("Cannot be deleted");
        $user->delete();
        return response()->json($user);
    }
}
