<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Contact;

class ContactUs extends Component
{
	public $name       = '';
	public $email      = '';
	public $topic      = '';
	public $message    = '';

    public function render()
    {
        return view('livewire.user.contact-us')
            ->extends('layouts.user')
            ->section('content');
    }

    public function store(){
    	$this->validate([
    		'name'       => 'required|string',
    		'email'      => 'required|string',
    		'topic'      => 'required|string',
    		'message'    => 'required'
    	]);

    	Contact::create([
    		'name'       => $this->name,
    		'email'      => $this->email,
    		'topic'      => $this->topic,
    		'message'    => $this->message
    	]);

    	session()->flash('success', 'Your enquiry has been saved. We will get to you shortly.');

    	$this->name     = '';
		$this->email    = '';
		$this->topic    = '';
		$this->message  = '';

    }
}
