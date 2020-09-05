<?php

namespace App\Http\Livewire\Admin\Sponsers;

use Livewire\Component;
use App\Sponser;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $updatesQueryString = ['name', 'email', 'created_at'];
    public $name           = '';
    public $email          = '';
    public $created_at     = '';
    public $modal          = false;
    public $status         = false;

    public function render()
    {

        if($this->name || $this->email || $this->created_at){
            $this->goToPage(1);
        }

        $query     =  Sponser::latest();
        if($this->name) {
        	$query = $query
        				->where('full_name' ,   'LIKE', '%'. $this->name .'%');
        }
        
        $paginate  =  $query
                        ->where('email' ,   'LIKE', '%'. $this->email .'%')
                        
                        ->where('created_at' ,   'LIKE', '%'. $this->created_at .'%')
                        ->paginate(10)
                        ->appends(request()->query());

        return view('livewire.admin.sponsers.index', [
            'sponsers'     => $paginate,
            'first'        => $paginate->firstItem(),
            'last'         => $paginate->lastItem(),
            'total'        => $paginate->total()
        ]);

    }


    /* Set Model Visiibility*/
    public function setVisibility(){
    	$this->modal  = !$this->modal;
        $this->status = '';
    }

    /* Remove the User */
    public function drop($speaker){
    	// dd($speaker);
    	// $speaker = Speaker::findOrfail($speaker);
    	// $speaker->delete();
        $this->status = 'Success';
    }
}
