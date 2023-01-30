@extends('admin.layout.adminmaster')

@section('main-content')
	<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>Verified Users</h3>
		</div>
		<div class="title_right">
			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-secondary" type="button">Go!</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 ">
			<div class="x_panel">
				<div class="x_title">
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
			</ul>
			<div class="clearfix"></div>
		</div>
		@error('verification_check')
			<div class="alert alert-danger alert-block">
			              <button type="button" class="close" data-dismiss="alert">×</button> 
			                    <strong>{{ $message }}</strong>
			            </div>
		@enderror
		<div class="x_content">
			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>UserName</th>
									<th>Phone Or Email</th>
									<th>Required Amount</th>
									<th>Images</th>
									<th>Videos</th>
									<th>Documents</th>
									<th>Created At</th>
									<th>Verification Check</th>
								</tr>
							</thead>
							<tbody>
								@foreach($postDatas as $postData)
								@if($postData->verified != 'Non-Verify' && $postData->verification_check == 'Process' )
								<tr>
									<td>{{ $postData->user_name }}</td>
									<td>{{ $postData->user_emailorphone }}</td>
									<td>{{ $postData->donation_amount }}</td>
									<td  style="background-color: black">
										@foreach(json_decode($postData->images) as $image)
											<img src="{{ asset('filenames/'.$image) }}" width="70" height="70" onclick="openImage(this.src)" style="margin: 5px">
										@endforeach
									</td>
									<td  style="background-color: black">
										@foreach(json_decode($postData->videos) as $video)
											<video src="{{ asset('postvideo/'.$video) }}" width="100" height="100" onclick="openVideo(this.src)" style="margin: 5px" controls></video>
										@endforeach
									</td>
									<td>{{ $postData->documents }}</td>
									<td>{{ Carbon\Carbon::parse($postData->created_at)->format('l M j, Y') }} at {{ $postData->created_at->format('h:i A') }} </td>
									<td>
										{{-- 
										<form action="{{ route('admin.verified',['post_id' => $postData->id,'user_id' => $postData->user_id]) }}" method="get">
											@csrf
										<label><input type="checkbox" value="checked" 
											@if($postData->verification_check == 'verified')
												{{ "checked" }}
											@else
												{{ "" }}
											@endif
										 name="verification_check">
										 	@if($postData->verification_check == 'verified')
										 		{{ "Verified" }}
										 	@else
										 		{{ "Process" }}
										 	@endif
										</label>
										<button type="submit">Submit</button>
										</form>--}}
										<form action="{{ route('adminVerified',['post_id' => $postData->id,'user_id' => $postData->user_id]) }}" method="post">
										  @csrf
										  <input type="checkbox" name="verification_check" value="{{ $postData->verification_check != 'Verified' ? 'Verified' : 'Process' }}">
										  <input type="submit" value="Submit">
										</form>
									</td> 
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
	function openImage(src) {
		window.open(src,'_blank')
	}
</script>
<script>
	function openVideo(src) {
		window.open(src,'_blank')
	}
</script>

@endsection