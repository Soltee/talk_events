<?php

namespace App\Http\Livewire\User\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
Use Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

class Profile extends Component
{
	use WithFileUploads;

	public $auth;
    public $avatar;
    public $oldAvatar;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $password_confirmation;


	public function mount()
    {
    	// return ($this->guard()->user() ? '' : redirect()->to('/login'));
        $this->auth      = $this->guard()->user();
        if(env('APP_ENV') === 'local'){
        	$this->oldAvatar = '/storage/users/' . $this->auth->avatar;
        }

        $this->firstname = $this->auth->first_name;
        $this->lastname  = $this->auth->last_name;
        $this->email     = $this->auth->email;
    }

    public function render()
    {
    	// dd($this->oldAvatar);
        return view('livewire.user.auth.profile', [
        		'oldAvatar' => $this->oldAvatar,
        		'auth'      => $this->auth
        	])
            ->extends('layouts.user')
            ->section('content');
    }


    /** Modal Visibility */
    public function setVisibility(){
        $this->modal  = !$this->modal;
        $this->status = '';
    }

    /**Save Avatar */
    public function save()
    {
        $this->validate([
            'avatar' => 'image|max:1024', // 1MB Max
        ]);

        if($this->auth->avatar){
        	Storage::delete($this->auth->avatar);
        }

        $avatar = $this->avatar->store('users', 'public');
        // open file a image resource
        // $img = Image::make($avatar);

        // $img->fit(200, 200, function ($constraint) {
        //     $constraint->upsize();
        // });

        // $img->save();

        $this->guard()->user()->update([
        	'avatar'      => '/storage/' .$avatar
        ]);

        //Dispatch That avatar was saved
        $this->dispatchBrowserEvent('user-avatar-updated', [
            'type'       => "success",
            'text'       => "",
            'message'    =>  "Avatar was saved."
        ]);
        
    }


    /**Save Info */
    public function update()
    {
        $this->validate([
            'firstname' => 'required|string', 
            'lastname'  => 'required|string', 
            'email'     => 'required|string|email', 
        ]);

        $this->guard()->user()->update([
        	'first_name' => $this->firstname,
        	'last_name'  => $this->lastname,
        	'email'      => $this->email
        ]);

        //Dispatch That profiel Was saved
        $this->dispatchBrowserEvent('user-updated', [
            'type'       => "success",
            'text'       => "",
            'message'    =>  "Profile saved."
        ]);        

    }


    /**Change Password */
    public function change()
    {
        $this->validate([
            'password'     => 'required|string|min:8|confirmed', 
        ]);

        $this->guard()->user()->update([
        	'password'      => bcrypt($this->password)
        ]);

        //Dispatch That password was save
        $this->dispatchBrowserEvent('user-password-updated', [
            'type'       => "success",
            'text'       => "",
            'message'    =>  "Password was saved."
        ]);

        //Rest 
        $this->password  = '';
        $this->password_confirmation   = '';

    }

    /*Guard*/
    protected function guard(){
    	return Auth::guard();
    }
}
