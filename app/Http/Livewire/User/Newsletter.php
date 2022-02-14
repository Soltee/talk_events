<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Newsletter as News;

class Newsletter extends Component
{
    public $agree;
    public $email;
    public $visibility = false;
    public $message;

    public function render()
    {
        return view('livewire.user.newsletter')
            ->extends('layouts.user')
            ->section('content');
    }


    /*Set Message Visibility*/
    public function setVisibility(){
        $this->visibility = !$this->visibility;
        $this->message = '';
    }

    /** Subscribe */
    public function subscribe()
    {
    	$data = $this->validate([
            'email'       => 'required|email:rfc,dns',
            'agree'       => 'required|bool'
    	]);

    	// if($this->isSubscribed($data['email'])){
    	// 	return session()->flash('success', 'Your email has already been  added to our list.');
    	// }

    	// News::subscribe($data['email']);

        $this->visibility = true;
        $this->message    = 'Thanks for Subscribing! Your email has been added to our list.';
        $this->email      = '';
        $this->agree      = false;

    }

    protected function isSubscribed($user)
    {
    	return News::isSubscribed($user);
    }
}
