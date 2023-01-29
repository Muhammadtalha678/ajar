@extends('ajarLayout.master')
@section('main-content')
    <div class="col-12 col-lg-9 pb-5 ">
	<div class="container-fluid">
        <div class="d-flex flex-column justify-content-center w-100 mx-auto" style="padding-top: 56px; max-width: 850px">
		@if(session()->has("success"))
			<div class="alert alert-success alert-block" id="error">
			  <button type="button" class="close" data-dismiss="alert">×</button> 
			        <strong>{{ session()->get("success") }}</strong>
			</div>
		@endif
            <!-- create post -->
            @foreach($NonVerifypostDatas as $NonVerifypostData)
            @if($NonVerifypostData->verified == 'Non-Verify')
        <div class="bg-white p-4 rounded shadow mt-3">
                <!-- author -->
                @error('donation_amount', 'post_'.$NonVerifypostData->id)
                    <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{$message }}</strong>
                    </div>
                @enderror
                @if(session()->has("error_post_$NonVerifypostData->id"))
                    <div class="alert alert-danger alert-block" id="error">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ session()->get("error_post_$NonVerifypostData->id") }}</strong>
                    </div>

                @endif
                @if(session()->has("success_post_$NonVerifypostData->id"))
                    <div class="alert alert-success alert-block" id="success">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ session()->get("success_post_$NonVerifypostData->id") }}</strong>
                    </div>

                @endif
                <div class="d-flex justify-content-between">
                    
                    <!-- avatar -->
                    <div class="d-flex">
                        <img src="{{ asset('/user_image/'.$NonVerifypostData->user_image) }}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover" />
                        <div>
                            <p class="m-0 fw-bold">{{ $NonVerifypostData->user_name }}
                                @if($NonVerifypostData->verified == 'Non-Verify')
                            <img src="{{ asset('crossIcon.png') }}" class="icons" width="20px" height="20px">
                            {{-- <i class="fas fa-check-circle text-success fs-2"></i> --}}
                            {{ $NonVerifypostData->verified }}
                        @endif
                            </p>
                        
                            <span class="text-muted fs-7"><span class="post-time">
                                {{-- {{ $NonVerifypostData->created_at->diffForHumans() }} --}}
                                {{-- l = day, h = hour ,i = minute, A = AM or PM   --}}
                                {{-- @if($NonVerifypostData->created_at->diffForHumans() != '1 day ago')
                                    {{$NonVerifypostData->created_at->diffForHumans()}}
                                @else
                                {{ $NonVerifypostData->created_at->format('l') }} at
                                {{ $NonVerifypostData->created_at->format('h:i A') }}
                                @endif
                                 --}}
                                 @if(Carbon\Carbon::parse($NonVerifypostData->created_at)->isToday())
                                 {{ Carbon\Carbon::parse($NonVerifypostData->created_at)->diffForHumans(); }} .  @include('ajarfirstpage.facebooktimeIcon')

                                    @elseif(Carbon\Carbon::parse($NonVerifypostData->created_at)->isYesterday())
                                        Yesterday at {{ Carbon\Carbon::parse($NonVerifypostData->created_at)->format('h:i A') }} . @include('ajarfirstpage.facebooktimeIcon')
                                    @else
                                        {{ Carbon\Carbon::parse($NonVerifypostData->created_at)->format('l M j, Y') }} at {{ $NonVerifypostData->created_at->format('h:i A') }} .  @include('ajarfirstpage.facebooktimeIcon')
                                    @endif
                            </span>
                            
                            <!-- <label class="heart" for="heart-checkbox"></label> -->
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="wrapper">
                        
                        
                        <p class="show-read-more">{{ $NonVerifypostData->caption }}.</p>
                        <div class="post-images" style="background-color:lightgreen;display: flex; flex-wrap:wrap; ">
                            @foreach(json_decode($NonVerifypostData->images) as $image)
                                    <img src="{{ asset('/filenames/'.$image) }}"  onclick="openImage(this.src)" class="post-image" style="width: 30%;margin: 10px">
                            @endforeach
                            {{-- {{ $NonVerifypostData->videos }} --}}
                            @if($NonVerifypostData->videos)
                                @foreach(json_decode($NonVerifypostData->videos) as $video){{-- 
                                    <video controls onclick="openImage(this.src)" >
                                        <source src="{{ asset('/Postvideo/'.$video) }}" type="video/mp4" onclick="openVideo(this.src)">
                                    </video> --}}
                                    <video onclick="openVideo(this.src)" src="{{ asset('/Postvideo/'.$video) }}" style="width: 30%;margin: 10px"  controls ></video>
                                @endforeach
                            @endif
                        </div>

                        
                    </div>
                    <script>
                        function openImage(src) {
                            window.open(src,'_blank');
                        }
                    </script>
                    <script>
                        function openVideo(src) {
                            window.open(src,'_blank');
                        }
                    </script>
                    <!-- likes -->
                    <!-- comments start-->
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item border-0">
                            <!-- comment collapse -->
                            <h2 class="accordion-header" id="headingTwo">
                            <br>
                            <div class="table-responsive-sm">
                                <table class="table table-bordered border-success">
                                    <tr>
                                        <td>
                                            {{-- <div class="progress">
                                                <div class="progress__fill"></div>
                                                <span class="progress__text">10%</span>
                                            </div> --}}
                                            <div>
                                                Required Amount : {{ $NonVerifypostData->donation_amount }} Rs
                                            </div>
                                            <div>
                                                Remaining Amount : {{ $NonVerifypostData->remaining_amount }} Rs
                                            </div>
                                            <div style="width: 100%;height: 20px;background-color: #ddd;border-radius: 5px;">
                                                @if($NonVerifypostData->remaining_amount == 0)
                                                        
                                                        <p class="text-center">Donation Completed</p>
                                                        @endif     
                                                <div style="width: {{($NonVerifypostData->remaining_amount/$NonVerifypostData->donation_amount)*100}}%;height: 100%;background-color: #4CAF50;border-radius: 5px;" >
                                                    <p class="text-center">
                                                        @if($NonVerifypostData->remaining_amount != 0)
                                                        {{ round(($NonVerifypostData->remaining_amount/$NonVerifypostData->donation_amount)*100) }}%
                                                    
                                                        @endif
                                                    </p>
                                                </div>
                                        </td>
                                        <td>
                                            <form class="row g-3" action="{{ route('donate',['post_id' => $NonVerifypostData->id,'user_id' => $NonVerifypostData->user_id]) }}" method="post">
                                                @csrf
                                                <div class="col-auto">
                                                    @if($NonVerifypostData->remaining_amount != 0 )
                                                    <input type="Enter Amount" class="form-control" id="inputAmount" placeholder="Enter Your Donation Amount" name="donation_amount" value="{{ old('donation_amount') }}">

                                                </div>
                                                <div class="col-auto">
                                                    <button type="submit" class="btn btn-success mb-3">Donate</button>
                                                </div>
                                                   @else
                                                    Donation Completed
                                                   @endif
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            </h2>
                            <hr />
                            <!-- comment & like bar -->
                            @if($NonVerifypostData->remaining_amount != 0 )
                            <div class="d-flex justify-content-around">
                                <div class="dropdown-item d-flex justify-content-center">
                                    
                                    <a href="{{ route('upvote',['post_id' => $NonVerifypostData->id]) }}" class="upvote" style="color: black;text-decoration: none;"><i class="fas fa-arrow-up me-3"></i>
                                    Upvote 
                                    {{-- {{ $NonVerifypostData->id }} --}}
                                </a> 
                                <?php $upvoteInc = 0;?>
                                   @foreach($NonVerifypostData->votechild as $upvote)
                                        <?php $upvoteInc+=$upvote->total_upvotes;?>

                                   @endforeach
                                                ({{ $upvoteInc }})
                                </div>
                                    {{-- {{ $NonVerifypostData->votechild }} --}}

                                    
                                <div class="dropdown-item d-flex justify-content-center">
                                    
                                    
                                        <a href="{{ route('downvote',  ['post_id' => $NonVerifypostData->id]) }}" class="downvote" style="color: black;text-decoration: none;"><i class="fas fa-arrow-down me-3"></i>Downvote
                                            {{ $NonVerifypostData->total_votes }}
                                        </a>
                                    
                                   {{--   <?php $downvoteInc = 0;?>
                                    @foreach($showdownvote[0]['votechild'] as $downvote)
                                     <?php  $downvoteInc+=$downvote->downvote?>
                                    @endforeach
                                         ({{ $downvoteInc }}) --}}
                                </div>
                            </div>
                            @else
                                <p class="text-center">Thanks For your Support</p>
                            @endif
                            <!-- comment expand -->
                            <hr />
                            
                        </div>
                    </div>
                    <!-- end -->
                </div>
        </div>
            @endif
@endforeach
        </div>
    </div>
</div>
@include('ajarfirstpage.scriptLinks')

@endsection