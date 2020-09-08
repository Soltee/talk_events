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
    public $message      = '';
    public $status       = false;

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


    /**Close*/
    public function close(){
        $this->status  = false;
        $this->message = '';
    }

    /* Remove the Sponser */
    public function drop($sponser){
    	// dd($sponser);
    	$sponser = Sponser::findOrfail($sponser);
    	$sponser->delete();
        $this->status = true;
        $this->message = $sponser->full .' deleted.';
    }
}
