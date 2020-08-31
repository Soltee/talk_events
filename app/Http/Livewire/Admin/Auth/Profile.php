<?php

namespace App\Http\Livewire\Admin\Auth;

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
        	$this->oldAvatar = '/storage/admin/' . $this->auth->avatar;
        }

        $this->firstname = $this->auth->first_name;
        $this->lastname  = $this->auth->last_name;
        $this->email     = $this->auth->email;
    }

    public function render()
    {

        return view('livewire.admin.auth.profile', [
        		'oldAvatar' => $this->oldAvatar,
        		'auth'      => $this->auth
        	]);
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

        $avatar = $this->avatar->store('admin', 'public');
        // open file a image resource
        // $img = Image::make($avatar);

        // $img->fit(200, 200, function ($constraint) {
        //     $constraint->upsize();
        // });

        // $img->save();

        $this->guard()->user()->update([
        	'avatar'      => $avatar
        ]);

        $this->firstname = '';
        $this->lastname  = '';
        $this->email     = '';
        $this->avatar    = '';
        $this->password  = '';
        $this->confrim   = '';

        session()->flash('done', 'Your avatar is saved.');
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

        $this->avatar    = '';
        $this->password  = '';
        $this->password_confirmation   = '';

        session()->flash('done', 'Your info is saved.');


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

        $this->firstname = '';
        $this->lastname  = '';
        $this->email     = '';
        $this->avatar    = '';
        $this->password  = '';
        $this->password_confirmation   = '';

        session()->flash('done', 'Your password is saved.');

    }

    /*Guard*/
    protected function guard(){
    	return Auth::guard();
    }
}
