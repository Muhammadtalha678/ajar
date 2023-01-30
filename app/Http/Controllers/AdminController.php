<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Admin;
use Auth;
class AdminController extends Controller
{
	public function index()
	{
		return view('admin.home');
	}
	public function verified()
	{
		$postDatas = Post::all(); 
		return view('admin.verified',compact('postDatas'));
	}
	public function nonVerified()
	{
		$postDatas = Post::all(); 
		return view('admin.nonVerified',compact('postDatas'));
	}
	public function storenonVerified(Request $request ,$post_id,$user_id)
	{
		$request->validate([
			'verification_check' => 'required'
		]);
		$userFind = User::findorFail($user_id);
		$postFind = Post::findorFail($post_id);
		Admin::create([
			'user_id' => $userFind->id,  
			'post_id' => $postFind->id,
			'admin_id' => Auth::user()->id,
			'verification_check' => $request->verification_check 
		]);
		// $post = new Post();
		$postFind->verification_check = $request->verification_check;
		$postFind->update();
		return redirect()->route('admin.verified')->with('success','Post Verified Successfully');
		// echo $request->verification_check;
		// echo $post_id;
		// echo $user_id;
	}
}
