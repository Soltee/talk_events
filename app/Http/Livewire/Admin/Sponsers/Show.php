<?php
namespace App\Http\Livewire\Admin\Sponsers;

use Livewire\Component;
use App\Sponser;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    public $sponser;
    public $modal          = false;
    public $status         = false;

    public function mount(Sponser $sponser){
    	$this->sponser = $sponser;
    }

    public function render()
    {
    	$events = $this->sponser->events()->paginate(4);
        return view('livewire.admin.sponsers.show', [
        		'sponser'       => $this->sponser,
        		'events'        => $events,
        		'events_count'  => $events->total(),
        	]);
    }

    /* Set Model Visiibility*/
    public function setVisibility(){
    	$this->modal  = !$this->modal;
        $this->status = '';
    }

    /* Remove the User */
    public function drop($sponser){
    	// dd($sponser);
    	// $sponser = Sponser::findOrfail($sponser);
    	// $sponser->delete();
        $this->status = 'Success';
        session()->flash('success', 'User dropped');
    	return redirect()->to('/admin/sponsers');
    }

}
