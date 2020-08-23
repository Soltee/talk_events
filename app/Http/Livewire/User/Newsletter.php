<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Newsletter as News;

class Newsletter extends Component
{
	public $email;

    public function render()
    {
        return view('livewire.user.newsletter');
    }

    public function subscribe()
    {
    	$data = $this->validate([
            'email'       => 'required|email',
    	]);

    	if($this->isSubscribed($data['email'])){
    		return session()->flash('success', 'Your email has already been  added to our list.');
    	}

    	News::subscribe($data['email']);

    	session()->flash('success', 'Your email has been added to our list.');
    }

    protected function isSubscribed($user)
    {
    	return News::isSubscribed($user);
    }
}
