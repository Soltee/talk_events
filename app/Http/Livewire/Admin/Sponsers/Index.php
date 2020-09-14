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
        if($this->name) {
            $paginate = Sponser::latest()
                        ->where('full_name' ,   'LIKE', '%'. $this->name .'%')
                        ->paginate(10)
                        ->appends(request()->query());
        } elseif ($this->email) {
            
            $paginate  =  Sponser::latest()
                            ->where('email' ,   'LIKE', '%'. $this->email .'%')
                            ->paginate(10)
                            ->appends(request()->query());
        } elseif ($this->created_at) {
            
            $paginate  =  Sponser::latest()
                            ->where('created_at' ,   'LIKE', '%'. $this->created_at .'%')
                            ->paginate(10)
                            ->appends(request()->query());
        } else {
        
            $paginate  =  Sponser::latest()                            
                            ->paginate(10)
                            ->appends(request()->query());
        }

        return view('livewire.admin.sponsers.index', [
            'sponsers'     => $paginate
        ]);

    }

    public function updatedName()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->name) {
            $this->name = null;
        }

        $this->gotoPage(1);
    }

    public function updatedEmail()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->email) {
            $this->email = null;
        }

        $this->gotoPage(1);
    }

    public function updatedCreated_at()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->created_at) {
            $this->created_at = null;
        }

        $this->gotoPage(1);
    }

    /**Close*/
    public function close(){
        $this->status  = false;
        $this->message = '';
    }

    /* Remove the Sponser */
    public function drop($sponser){
    	// dd($sponser);
        abort_if(!auth()->user()->can('delete sponsers'), 403);
    	$sponser = Sponser::findOrfail($sponser);
        if($sponser->avatar){
            File::delete([
                public_path($sponser->avatar)
            ]);
        }
    	$sponser->delete();
        $this->status = true;
        $this->message = $sponser->full .' deleted.';
    }
}
