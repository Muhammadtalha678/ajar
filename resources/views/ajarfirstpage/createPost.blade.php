{{-- <div class="modal-body">
    <div class="my-1 p-1">
        <div class="d-flex flex-column">
            <!-- name -->
            <div class="d-flex align-items-center">
                <div class="p-2">
                    <img src="https://source.unsplash.com/collection/happy-people" alt="from fb" class="rounded-circle" style="
                    width: 38px;
                    height: 38px;
                    object-fit: cover;
                    " />
                </div>
                <div>
                    <p class="m-0 fw-bold">John</p>
                    <form action="{{ route('ajarLayout.store') }}" method="post">
                        @csrf
                        <select class="form-select border-0 bg-gray w-75 fs-7" aria-label="Default select example" name="verified">
                            <option selected value="1">Verify By Ajar</option>
                            <option value="2">Verify By NGOs</option>
                            <option value="3">Non-Verify</option>
                        </select>
                        
                    </div>
                </div>
                </br>
                <!-- text -->
                <div>
                    <div class="border  border-1 border-dark "   contentEditable="true">..
                        
                        
                        
                        <img id="output" width="100%" height="100%" />
                        <video width="100%" height="100%" id="video_disabled" controls style="display:none;">
                            
                        </video>
                    </div>
                </div>
                <!-- emoji  -->
                
                <!-- options -->
                <div class="
                    col-auto
                    d-flex
                    justify-content-between
                    border border-1 border-light
                    rounded
                    p-3
                    mt-3
                    ">
                    <input type="Enter your Amount" id="inputyourAmount" placeholder="Enter Your Amount">
                    <div>
                        <!-- <label for="input">images</label>
                        <input type="file" name="file"> -->
                        <p><label for="file" style="cursor: pointer;"><i class="fas fa-images text-danger"></i>
                            <p><input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none;" multiple="multiple"></p>
                        </label></p>
                        <!-- video -->
                        <p><label type='file' style="cursor: pointer;" ><i class="fas fa-video text-warning"></i>
                            <input type='file' id='videoUpload' onclick="clickvideo()" style="display: none;" />
                        </label></p>
                        <!-- <p><img id="output" width="30px" height="30px" /></p> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end -->
    </div>
    <!-- footer -->
    <div class="modal-footer">
        <button type="button" class="btn btn-primary w-100">
        Post
        </button>
    </form>
</div> --}}
<form id="create-post-form" action="{{ route('ajarLayout.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3 ">
        <select class="form-select border-0 bg-gray w-75 fs-7" aria-label="Default select example" name="verified" class="form-control">
            <option selected value="">how would you verify</option>
            <option  value="Verify By Ajar" {{ old('verified') == 'Verify By Ajar' ? 'selected' : '' }}>Verify By Ajar</option>
            <option value="Verify By NGOs" {{ old('verified') == 'Verify By NGOs' ? 'selected' : ''  }}>Verify By NGOs</option>
            <option value="Non-Verify" {{ old('verified') == 'Non-Verify' ? 'selected' : ''  }}>Non-Verify</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <textarea class="form-control" id="post-content" rows="3" name="caption"></textarea>
    </div>
    <div class="form-group mb-3">
        <input type="text" name="donation_amount" class="form-control" value="{{ old('donation_amount') }}">
    </div>
    <div class="form-group mb-3">
        <input type="file" class="form-control" name="images[]" id="images" multiple style="display:none">
        
        <div class="images-preview mb-3" id="images-container">
            {{-- <?php var_dump(old('images.*') != ''); ?> --}}
           {{--   @if(old('images'))
            @foreach(old('images') as $image)
                <img src="{{ $image }}" alt="Image">
            @endforeach
            @endif --}}
            
            <!-- Add more images here -->
        </div>
        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
        <button type="button" id="add-images-button">Add Images</button>
    </div>
     <div class="form-group mb-3">
        <input type="file" class="form-control" name="videos[]" id="videos" multiple style="display:none" accept="video/mp4, video/webm, video/ogg">
        
        <div class="videos-preview mb-3" id="videos-container">
            {{-- <?php var_dump(old('images.*') != ''); ?> --}}
           {{--   @if(old('images'))
            @foreach(old('images') as $image)
                <img src="{{ $image }}" alt="Image">
            @endforeach
            @endif --}}
            
            <!-- Add more images here -->
        </div>
        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
        <button type="button" id="add-videos-button">Add Videos</button>
    </div>
    <button type="submit" class="btn btn-primary" id="create-post-button">Post</button>
</form>
<div id="usernameContainer">
  <p id="username">{{ Auth::user()->name }}</p>
  <button id="editBtn">Edit</button>
</div>


<script>
// Select the file input and add images preview container
var fileInput = document.getElementById('images');
var imagesPreview = document.querySelector('.images-preview');
// Add event listener to add-images-button
document.getElementById('add-images-button').addEventListener('click', function() {
fileInput.click();
});
Re// Listen for changes on the file input
fileInput.addEventListener('change', function() {
// Get the selected files
var files = this.files;
// Loop through the files
for (var i = 0; i < files.length; i++) {
// Create an img element
var img = document.createElement('img');
// Create a URL for the image
var imgURL = URL.createObjectURL(files[i]);
// console.log(imgURL);
// Set the src of the img element to the image URL
img.src = imgURL;
// img.height = '100';
// img.width = '100';
// Add the img element to the images preview container
imagesPreview.appendChild(img);
}
});
</script>
<script>
    var filevideoInput = document.getElementById('videos');
    var videosPreview = document.querySelector('.videos-preview');
    // Add event listener to add-images-button
    document.getElementById('add-videos-button').addEventListener('click', function() {
    filevideoInput.click();
    });
    // Listen for changes on the file input
    filevideoInput.addEventListener('change', function() {
    // Get the selected files
    var files = this.files;
    // Loop through the files
    for (var i = 0; i < files.length; i++) {
    // Create an img element
    var video = document.createElement('video');
    var videoSource = document.createElement('source');
    // Create a URL for the image
    video.appendChild(videoSource);
    var videoURL = URL.createObjectURL(files[i]);
    // console.log(imgURL);
    // Set the src of the img element to the image URL
    video.src = videoURL;
    video.height = '200';
    video.width = '200';
    // Add the img element to the images preview container
    videosPreview.appendChild(video);
    }
    });
</script>