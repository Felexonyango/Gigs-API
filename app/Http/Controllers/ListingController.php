<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $post = Listing::all();
        if ($post) {
            return response()->json(['success' => true, 'succes' => $post]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules=[
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
             'website' => 'required',
             'email' => 'required',
             'description' => 'required'
             
        ];
        $input  = $request->only('title','company','location','website','email','description');
        $validator = Validator::make($input, $rules);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        
        }
    
        $post['user_id'] = auth()->id();

        $post= Listing::create([
            'title'=>$request['title'],
            'company'=>$request['company'],
            'location' =>$request['location'],
            'website' =>$request['website'],
            'email'=>$request['email'],
            'description'=>$request['description']
    
        ]);
        return response()->json(['success' => true, 'succes' => $post]);
        
    
        }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $post = Listing::find($id);
        if ($post) {
            return response()->json(['success' => true, 'succes' => $post]);
        }
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
