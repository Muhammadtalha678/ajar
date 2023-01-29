@extends('ajarLayout.master')
@section('main-content')
<div class="container-fluid">
    @if($errors->any())
    <br>
    <br>
    <br>
    <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
    @endif
    <div class="col-12 col-lg-9 pb-5 ">
        <div class="d-flex flex-column justify-content-center w-100 mx-auto" style="padding-top: 56px; max-width: 850px">
            @if(session()->has("success"))
            <div class="alert alert-success alert-block" id="error">
              <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ session()->get("success") }}</strong>
            </div>
            @endif
            <!-- create post -->
            <div class="bg-white p-3 mt-3 rounded border shadow">
                <!-- avatar -->
                <div class="d-flex" type="button">
                    <div class="p-1">
                        <img src="{{ asset('/user_image/'.Auth::user()->user_image) }}" alt="user_image" class="rounded-circle me-2" style="width: 35px; height: 35px; object-fit: cover" />
                    </div>
                    <input type="text" class="form-control rounded-pill border-0 bg-gray pointer" disabled placeholder="What's on your mind, {{ Auth::user()->name }}?" data-bs-toggle="modal" data-bs-target="#createModal" />
                </div>
                <!-- create modal -->
                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" data-bs-backdrop="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <!-- head -->
                            <div class="card">
                                <div class="card-header modal-header align-items-center">
                                    <h5 class="text-dark text-center w-100 m-0" id="exampleModalLabel">
                                    Create Post
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="card-body">
                                    @include('ajarfirstpage.createPost')
                                    {{-- <form id="create-post-form">
                                        <div class="form-group">
                                            <textarea class="form-control" id="post-content" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="create-post-button">Post</button>
                                    </form> --}}
                                </div>
                            </div>
                            {{-- <div class="modal-header align-items-center">
                                <h5 class="text-dark text-center w-100 m-0" id="exampleModalLabel">
                                Create Post
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- body -->
                            <!-- content crete post start -->
                            @include('ajarfirstpage.createPost') --}}
                            <!-- content create post end -->
                        </div>
                    </div>
                </div>
                <hr />
                <!-- actions -->
                <div class="d-flex flex-column flex-lg-row mt-3">
                    <!-- a 1 -->
                    <div class="
                        dropdown-item
                        rounded
                        d-flex
                        align-items-center
                        justify-content-center
                        " type="button">
                        <i class="fas fa-file me-2 text-danger"></i>
                        <!-- <p class="m-0 text-muted">Documentation</p> -->
                        <a href="" class="m-0 text-muted" data-bs-toggle="modal" data-bs-target="#createModal">Documentationn</a>
                    </div>
                    <!-- a 2 -->
                    <div class="
                        dropdown-item
                        rounded
                        d-flex
                        align-items-center
                        justify-content-center
                        " type="button">
                        <i class="fas fa-image me-2 text-success"></i>
                        <a href="" class="m-0 text-muted" data-bs-toggle="modal" data-bs-target="#createModal">Photo</a>
                    </div>
                    <!-- a 3 -->
                    <div class="
                        dropdown-item
                        rounded
                        d-flex
                        align-items-center
                        justify-content-center
                        " type="button">
                        <i class="fas fa-video me-2 text-warning"></i>
                        <a href="" class="m-0 text-muted" data-bs-toggle="modal" data-bs-target="#createModal">Videos</a>
                    </div>
                </div>
            </div>
            <!-- create room -->
            <!-- post content -->
            {{-- {{ $name = Auth::user()->timezone }} --}}
            {{-- @if(Session::has('error'))
                <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('error') }}</strong>
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('success') }}</strong>
                </div>
            @endif --}}

            @include('ajarfirstpage.showPost')
        </div>
    </div>
</div>

<!-- ================= Chat Icon ================= -->
@include('ajarfirstpage.scriptLinks')
@endsection