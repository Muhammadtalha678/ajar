@foreach($postDatas as $postData)
        <div class="bg-white p-4 rounded shadow mt-3">
                <!-- author -->
                @error('donation_amount', 'post_'.$postData->id)
                    <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{$message }}</strong>
                    </div>
                @enderror
                @if(session()->has("error_post_$postData->id"))
                    <div class="alert alert-danger alert-block" id="error">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ session()->get("error_post_$postData->id") }}</strong>
                    </div>

                @endif
                @if(session()->has("success_post_$postData->id"))
                    <div class="alert alert-success alert-block" id="success">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ session()->get("success_post_$postData->id") }}</strong>
                    </div>

                @endif
                <div class="d-flex justify-content-between">
                    
                    <!-- avatar -->
                    <div class="d-flex">
                        <img src="{{ asset('/user_image/'.$postData->user_image) }}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover" />
                        <div>
                            <p class="m-0 fw-bold">{{ $postData->user_name }}
                                @if($postData->verified == 'Verify By Ajar' || $postData->verified == 'Verify By NGOs')
                            <img src="{{ asset('checkicon.png') }}" class="icons" width="20px" height="20px">
                            {{-- <i class="fas fa-check-circle text-success fs-2"></i> --}}
                            {{ $postData->verified }}
                        @endif
                            </p>
                        
                            <span class="text-muted fs-7"><span class="post-time">
                                {{-- {{ $postData->created_at->diffForHumans() }} --}}
                                {{-- l = day, h = hour ,i = minute, A = AM or PM   --}}
                                {{-- @if($postData->created_at->diffForHumans() != '1 day ago')
                                    {{$postData->created_at->diffForHumans()}}
                                @else
                                {{ $postData->created_at->format('l') }} at
                                {{ $postData->created_at->format('h:i A') }}
                                @endif
                                 --}}
                                 @if(Carbon\Carbon::parse($postData->created_at)->isToday())
                                 {{ Carbon\Carbon::parse($postData->created_at)->diffForHumans(); }} .  @include('ajarfirstpage.facebooktimeIcon')

                                    @elseif(Carbon\Carbon::parse($postData->created_at)->isYesterday())
                                        Yesterday at {{ Carbon\Carbon::parse($postData->created_at)->format('h:i A') }} . @include('ajarfirstpage.facebooktimeIcon')
                                    @else
                                        {{ Carbon\Carbon::parse($postData->created_at)->format('l M j, Y') }} at {{ $postData->created_at->format('h:i A') }} .  @include('ajarfirstpage.facebooktimeIcon')
                                    @endif
                            </span>
                            
                            <!-- <label class="heart" for="heart-checkbox"></label> -->
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="wrapper">
                        
                        
                        <p class="show-read-more">{{ $postData->caption }}.</p>
                        
                    </div>
                    
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
                                                Required Amount : {{ $postData->donation_amount }} Rs
                                            </div>
                                            <div>
                                                Remaining Amount : {{ $postData->remaining_amount }} Rs
                                            </div>
                                            <div style="width: 100%;height: 20px;background-color: #ddd;border-radius: 5px;">
                                                @if($postData->remaining_amount == 0)
                                                        
                                                        <p class="text-center">Donation Completed</p>
                                                        @endif     
                                                <div style="width: {{($postData->remaining_amount/$postData->donation_amount)*100}}%;height: 100%;background-color: #4CAF50;border-radius: 5px;" >
                                                    <p class="text-center">
                                                        @if($postData->remaining_amount != 0)
                                                        {{ round(($postData->remaining_amount/$postData->donation_amount)*100) }}%
                                                    
                                                        @endif
                                                    </p>
                                                </div>
                                        </td>
                                        <td>
                                            <form class="row g-3" action="{{ route('donate',['post_id' => $postData->id,'user_id' => $postData->user_id]) }}" method="post">
                                                @csrf
                                                <div class="col-auto">
                                                    @if($postData->remaining_amount != 0 )
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
                            @if($postData->remaining_amount != 0 )
                            <div class="d-flex justify-content-around">
                                <div class="dropdown-item d-flex justify-content-center">
                                    
                                    <a href="{{ route('upvote',['post_id' => $postData->id]) }}" class="upvote" style="color: black;text-decoration: none;"><i class="fas fa-arrow-up me-3"></i>
                                    Upvote 
                                    {{-- {{ $postData->id }} --}}
                                </a> 
                                <?php $upvoteInc = 0;?>
                                   @foreach($postData->votechild as $upvote)
                                        <?php $upvoteInc+=$upvote->total_upvotes;?>

                                   @endforeach
                                                ({{ $upvoteInc }})
                                </div>
                                    {{-- {{ $postData->votechild }} --}}

                                    
                                <div class="dropdown-item d-flex justify-content-center">
                                    
                                    
                                        <a href="{{ route('downvote',  ['post_id' => $postData->id]) }}" class="downvote" style="color: black;text-decoration: none;"><i class="fas fa-arrow-down me-3"></i>Downvote
                                            {{ $postData->total_votes }}
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
@endforeach