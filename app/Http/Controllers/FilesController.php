<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files;
class FilesController extends Controller
{
    public function index()
    {
    	$images = Files::all();
    	return view('files',compact('images'));
    }
    public function store(Request $request)
    {
    	$request->validate([
    		'filenames.*' => 'required|image|mimes:jpeg,png,jpg'
    	]);
    	 foreach ($request->file('filenames') as $image)
    	 {
    	 	$ImageName = time().rand(1,1000).'.'.$image->extension();
    	 	$image->move(public_path('filenames'),$ImageName);
    	 	$filenames[] = $ImageName;	
    	 }
    	 $images = json_encode($filenames);
    	 // var_dump($images);exit();
    	 Files::create([
    	 	'filenames' => $images
    	 ]);
    	 return back()
            ->with('success','You have successfully file uplaod.')
            ->with('files',$filenames);
    }

}
