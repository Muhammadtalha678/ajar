<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function() {
$(".toggle_btn").click(function() {
$(this).toggleClass("active");
$(".wrapper ul").toggleClass("active");
if ($(".toggle_btn").hasClass("active")) {
$(".toggle_text").text("Show Less");
} else {
$(".toggle_text").text("Show More");
}
})
});
</script>
<script>
function updateProgressBar(progressBar, value) {
value = Math.round(value);
progressBar.querySelector(".progress__fill").style.width = `${value}%`;
progressBar.querySelector(".progress__text").textContent = `${value}%`;
}
const myProgressBar = document.querySelector(".progress");
/* Example */
updateProgressBar(myProgressBar, 50);
</script>
<script type="text/javascript">
let upvotebtn = document.querySelector('#upvotebtn');
let downvotebtn = document.querySelector('#downvotebtn');
let input1 = document.querySelector('#input1');
let input2 = document.querySelector('#input2');
upvotebtn.addEventListener('click', () => {
input1.value = parseInt(input1.value) + 1;
input1.style.color = "blue";
})
downvotebtn.addEventListener('click', () => {
input2.value = parseInt(input2.value) + 1;
input2.style.color = "red";
})
</script>
<script type="text/javascript">
function ImageButton1_OnClientClick(objImageButton) {
var TextArea1 = document.getElementById('TextArea1');
var Image1 = new Image();
Image1.src = objImageButton.src;
TextArea1.appendChild(Image1);
return false;
}
</script>
<script>
var loadFile = function(event) {
// document.getElementById("video_disabled").style.display = "none";
var image = document.getElementById('output');
image.src = URL.createObjectURL(event.target.files[0]);
};
document.getElementById("videoUpload")
.onchange = function(event) {
let file = event.target.files[0];
let blobURL = URL.createObjectURL(file);
document.querySelector("video").src = blobURL;
}
function clickvideo() {
console.log('heloooo')
// document.getElementById('#video_disabled').style.display = "block";
document.getElementById("video_disabled").style.display = "block";
}
</script>
<script>
$(document).ready(function(){
var maxLength = 300;
$(".show-read-more").each(function(){
var myStr = $(this).text();
if($.trim(myStr).length > maxLength){
var newStr = myStr.substring(0, maxLength);
var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
$(this).empty().html(newStr);
$(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
$(this).append('<span class="more-text">' + removedStr + '</span>');
}
});
$(".read-more").click(function(){
$(this).siblings(".more-text").contents().unwrap();
$(this).remove();
});
});
</script>
<script>
    $("#error").show();
    setTimeout(function() {
        $("#error").hide();
    }, 5000);
</script>
<script>
    $("#success").show();
    setTimeout(function() {
        $("#success").hide();
    }, 5000);
    
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>