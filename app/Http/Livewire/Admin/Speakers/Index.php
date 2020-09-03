<?php

namespace App\Http\Livewire\Admin\Speakers;

use Livewire\Component;
use App\Speaker;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $updatesQueryString = ['name', 'email', 'created_at'];
    public $name     = '';
    public $last_name      = '';
    public $email          = '';
    public $created_at     = '';
    public $modal          = false;
    public $status         = false;

    public function render()
    {
        if($this->first_name || $this->last_name || $this->email || $this->created_at){
            $this->goToPage(1);
        }

        $query     =  Speaker::latest();
        if($this->name) {
        	$query = $query
        				->where('first_name' ,   'LIKE', '%'. $this->name .'%')
                        ->orWhere('last_name' ,   'LIKE', '%'. $this->name .'%');
        }
        
        $paginate  =  $query
                        ->where('email' ,   'LIKE', '%'. $this->email .'%')
                        
                        ->where('created_at' ,   'LIKE', '%'. $this->created_at .'%')
                        ->paginate(10)
                        ->appends(request()->query());

        return view('livewire.admin.speakers.index', [
            'speakers'     => $paginate,
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
