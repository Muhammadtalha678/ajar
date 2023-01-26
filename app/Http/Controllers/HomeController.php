<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Vote;
use App\Models\DonateAmount;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    // SHOW POST DATA
    public function index()
    {
        // $postDatas = DB::table('verified_posting')
        //     ->select('verified_posting.*', DB::raw('COALESCE(SUM(votes.upvote), 0) as total_votes'))
        //     ->leftJoin('votes', 'verified_posting.id', '=', 'votes.post_id')
        //     ->groupBy('verified_posting.id','verified_posting.caption', 'verified_posting.verified',
        //         'verified_posting.donation_amount','verified_posting.remaining_amount','verified_posting.documents','verified_posting.images','verified_posting.videos','verified_posting.user_id','verified_posting.user_name','verified_posting.user_image',
        //         'verified_posting.created_at', 'verified_posting.updated_at')
        //     ->orderBy('total_votes', 'desc')
        //     ->get();
        // ORRR
        $postDatass = Post::with(['votechild' => function($query){
            $query->select('post_id',DB::raw('SUM(upvote) as total_upvotes'))
            ->groupBy('post_id')->orderBy('total_upvotes','Desc');
        }])->get();
        
        // $showdownvote = Post::with('votechild')->get();
        // ya jo $postDatas ky jo array hain un ki indexing kary ga descending order ky hisab sy js ky ziada upvote hn ky us array ka index no likh kr return kr dy ga 
        $postDatas = $postDatass->sortByDesc(function($post) {
            return $post->votechild->first()->total_upvotes ?? 0;
        });
        // echo($postDatas);exit();

    	// $postDatas = Post::latest()->get();
        //     foreach ($postData as $key) {
        //         foreach ($key->votechild as  $value) {
        //             # code...
        //         }
        //         # code...
        //     }
        // $postDatas = Post::find(2);
    	return view('ajarfirstpage.newsfeed',compact('postDatas'));
    }
    // STORE POST WITH USER_ID-NAME-IMAGE
    public function store(Request $request)
    {
    	$request->validate([
    		'caption' => 'required',
    		'verified' => 'required',
    		'donation_amount' => 'required|numeric',
    		// 'documents' => 'required',
    		'images.*' => 'required|image|mimes:jpeg,png,jpg',
    		'images' => 'required'
    		// 'videos' => 'required',
    	]);
    	if ($request->hasfile('images')) {
	    	foreach ($request->file('images') as $image) {
	    		$ImageName = time().rand(1,100).'.'.$image->extension();
	    		$image->move(public_path('filenames'),$ImageName);
	    		$filenames[] = $ImageName;
	    	}
	    	$images = json_encode($filenames);
	    	Post::create([
	    		'caption' => $request->caption,
	    		'verified' => $request->verified,
	    		'donation_amount' => $request->donation_amount,
                'remaining_amount' => $request->donation_amount,
	    		'images' => $images,
	    		'user_id' => Auth::user()->id,
	    		'user_name' => Auth::user()->name,
                'user_image' => Auth::user()->user_image,
	    		// 'created_at' => $currentTime,
	    		// 'updated_at' => $currentTime
	    	]);
	    	return redirect()->route('ajarLayout.newsfeed')->with('success','Post Create Successfully');
    	}
    	// Post::create([
    	// 	'caption' => $request->caption,
    	// 	'verified' => $request->verified,
    	// 	'donation_amount' => $request->donation_amount,
	    // 	'user_id' => Auth::user()->id,
	    // 	'user_name' => Auth::user()->name
    	// ]);
    	// return redirect()->route('ajarLayout.newsfeed')->with('success','Post Create Successfully');
    }
    // VOTE TABLE USE
    // VOTE STORE IN VOTE TABLE WITH POST_ID,POST_ID,VOTE
    public function upvote($post_id)
       {
        // 1)FIND POST ID IF EXISTS THEN THEY CAN VOTE
            $post = Post::findOrFail($post_id);
        // 2)USER CAN NOT UPVOTE TO OUR OWN POST
            if ($post->user_id == Auth::user()->id) {
                session()->flash("error_post_$post->id", "You cannot upvote your own post.");
                return back();
            }
            // 3)FIND VOTE DATA BY USER AND POST ID
            else{
                $vote = Vote::where('post_id',$post_id)->where('user_id',Auth::user()->id)->first();
            // 4) IF EXISTS THE VOTE DATA
                if ($vote) {
                // 5) IF THE USER ALREADY VOTE THE POST THEN THEY CANNOT UPVOTE AGAIN
                    if ($vote->vote == '1') {
                         session()->flash("error_post_$post->id", "You have already upvoted this post");
                            return back();
                    }
                // 6)ELSE THEY CAN VOTE
                    else{
                        $vote->vote = 1;
                        $vote->upvote +=1;
                        $vote->downvote -=1;
                        $vote->save();
                         session()->flash("success_post_$post->id", "Post Upvoted!");
                            return back();
                    }
                }
            // 4) NOT EXIST THE VOTE DATA THEY CAN VOTE
                else{
                    $vote = new Vote();
                    $vote->post_id = $post_id;
                    $vote->user_id = Auth::user()->id;
                    $vote->vote = 1;
                    $vote->upvote +=1;
                    $vote->save();
                     session()->flash("success_post_$post->id", "Post Upvoted!");
                            return back();
                }
                // echo var_dump($vote);exit();
            }
       }
       // VOTE TABLE USE
       // VOTE STORE IN VOTE TABLE WITH POST_ID,POST_ID,VOTE
       public function downvote($post_id)
       {
        // 1)FIND POST ID IF EXISTS THEN THEY CAN VOTE
            $post = Post::findOrFail($post_id);
            // 2)USER CAN NOT DOWNVOTE TO OUR OWN POST
            if ($post->user_id == Auth::user()->id) {
                session()->flash("error_post_$post->id", "You cannot downvote your own post.");
                return back();
            }
            // 2)ELSE USER ID AND POST ID NOT EQUAL THEN
            else{
                // 3)FIND VOTE DATA BY USER AND POST ID
                    $vote = Vote::where('post_id',$post_id)->where('user_id',Auth::user()->id)->first();
                // 4) IF EXISTS THE VOTE DATA
                    if ($vote) {
                    // 5) IF THE USER ALREADY VOTE THE POST THEN THEY CANNOT DOWNVOTE AGAIN
                        if ($vote->vote == -1) {
                            session()->flash("error_post_$post->id", "You have already downvoted this post");
                            return back();
                         }
                    // 6)ELSE THEY CAN VOTE
                        else{
                        $vote->vote = -1;
                        $vote->downvote +=1;
                        $vote->upvote -=1;
                        $vote->save();
                        session()->flash("success_post_$post->id", "Post Downvoted!");
                            return back();
                        }
                    }
                // 4) NOT EXIST THE VOTE DATA THEY CAN VOTE
                    else{
                    $vote = new Vote();
                    $vote->post_id = $post_id;
                    $vote->user_id = Auth::user()->id;
                    $vote->vote = -1;
                    $vote->downvote +=1;
                    $vote->save();
                        session()->flash("success_post_$post->id", "Post Downvoted!");
                            return back();
                    }
            }
       }

       // FOR Donate AMOUNT VALUE THE USER PROVIDE STORE IN donate AMOUNT tABLE















       public function donate_amount(Request $request ,$post_id,$user_id)
       {
            // $post = Post::findOrFail($post_id); same as $user_id come from donate pot form
            if ($user_id == Auth::user()->id) {
                session()->flash("error_post_$post_id", "You cannot donate yourself.");
                return back();
            }
           $validator = Validator::make($request->all(), [
               'donation_amount' => [
                   'required',
                   'numeric'
               ],
           ], [], ['donation_amount' => "Donation Amount"]);

           if ($validator->fails()) {
               return redirect()->back()->withErrors($validator->errors(), "post_$post_id");
           }
           // your code to handle a valid request
           $donation_amount = $validator->getData();
           $postData = Post::findOrFail($post_id);
           if ($postData->remaining_amount < $donation_amount['donation_amount']) {
             session()->flash("error_post_$post_id", "The amount required is ".$postData->remaining_amount." Rs");
             return back();  
           }
           else{
            $donationMinus = $postData->remaining_amount - $donation_amount['donation_amount'];
           // var_dump($donationMinus);exit();
            $postData->remaining_amount = $donationMinus; 
            $postData->update();
            $donatetotal = new DonateAmount();
            $donatetotal->post_id = $post_id;
            $donatetotal->user_id = Auth::user()->id;
            $donatetotal->donate_amount = $donation_amount['donation_amount'];
            $donatetotal->save();
            session()->flash("success_post_$post_id", "You have successfully donate ".$donation_amount['donation_amount']." Rs");
            return back();
           }


       }










}
