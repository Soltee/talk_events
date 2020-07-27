<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the company dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(auth()->user()->hasRole('user'), 403);

        $search = request()->keyw;

        $query = Category::latest();

        if($search){
            $query = $query->where('name', 'LIKE', '%'.$search.'%')
                            ->whereDate('created_at', '=', Carbon::today()->toDateString()); 
        }

        $paginate = $query->paginate(9);
        $categories   = $paginate->items();
        $total    = $paginate->total();
        $first    = $paginate->firstItem();
        $last     = $paginate->lastItem();
        $previous     = $paginate->appends(request()->input())->previousPageUrl();
        $next     = $paginate->appends(request()->input())->nextPageUrl();
        return view('admin.category.index', compact('categories', 'total', 'first', 'last', 'previous', 'next'));
    }


    /** Store */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->hasRole('event-manager'), 403);

        $data = $request->validate([
            'name'    => 'required|string|min:2',
        ]);

        $event = auth()->user()->events->create([
            'name'    => $data['name'],
            'slug'    => Str::slug($data['name']),    
        ]);

        return back()->with('success', 'Category created.');

    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        // dd($request->all());
        abort_if(!auth()->user()->hasRole('event-manager'), 403);

        $data = $request->validate([
            'name'               => 'required|string|min:2', 
        ]);
     
        // dd($request->all());
        $event = $event->update([
            'name'   => $data['name'],
            'slug'   => Str::slug($data['name']) 
        ]);

        return redirect()->back()->with('success', 'Category updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        abort_if(!auth()->user()->hasRole('event-manager'), 403);

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted.');
    }
}
