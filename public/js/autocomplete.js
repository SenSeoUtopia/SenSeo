// Back to Top

$(window).scroll(function() { 
if ($(this).scrollTop()>25)  { $('#Top').fadeIn("Slow"); }
else { $('#Top').fadeOut();}
});

$('#Top').ready(function() {
var away = false;
$('#Top').click(function() {
$("html, body").animate({scrollTop: 0}, 500);
return false;
});
});

$(document).on('click','.add-answer', function(e) {

var add_answer = "";
add_answer += "<div class=\"u-form-group answers\">";
add_answer += "<input type=\"text\" name=\"answers[]\" id=\"answers\" placeholder=\"Answers?\" required>";
add_answer += "<span class=\"remove-btn\"><i class=\"icon-cross\"></i></span>";
add_answer += "</div>";

$(add_answer).insertAfter( $( ".answers" ).last() );
});	

$(document).on('click','.answers .remove-btn', function(e) {

$(this).parent().remove();
});	

// Ajax Search
$(function(){

// Time Ago
if($("time").length > 0){
$("time").timeago();
}

$('[data-toggle="tooltip"]').tooltip({animation: true});

$("textarea").charCounter(144,{container: "#char-left"});

$('#search').typeahead({
order: "desc",
minLength:1,
dynamic: true,
cache: true,
emptyTemplate: 'No result for "{{query}}"',
delay: 0,
display: ["display_name", "user_name"],
template: '<span class="result">' +
'<span class="avatar">' +
'<img src="{{avatar}}">' +
"</span>" +
'<span class="full_name">{{display_name}} <span class="user_name">@{{user_name}}</span></span>'  +
"</span>",
source: {
href: function (item) {
var link_to_profile = base_url + '/' + item.user_name;	
return link_to_profile;
},	
url: [{
type: "post",
dataType: "json",
url: base_url+'/ajax/search',
data: {
q: "{{query}}"
}
}, "user"]
},
callback: {
onSendRequest: function(node, query) {
$("header .ajax-search .search-input").addClass('search-loading');
},
onReceiveRequest: function(node, query) {
$("header .ajax-search .search-input").removeClass('search-loading');
}
}
});



// Auto Load Next Pages
$('#search-results,#content').infinitescroll({
navSelector: "#Navigation",
nextSelector: "#Navigation a.next",
itemSelector: ".media_box",
extraScrollPx: 200,
animate: true,
loading: {
msgText: "Loading...",
finishedMsg: 'No More Series To Load.',
img: img_url+'ajax-loader.gif'
}
});

// Friend Request
$(".friend_request").click(function(){
$(".popup").fadeOut(300);
$("#friend_request_container").fadeToggle(300);
$("#friend_request_container").addClass('popup');
return false;
});

// Messages
$(".msg").click(function(){
$(".popup").fadeOut(300);
$("#messages_container").fadeToggle(300);
$("#messages_container").addClass('popup');
return false;
});

// Notification
$(".notification").click(function(){
$(".popup").fadeOut(300);
$("#notification_container").fadeToggle(300);
$("#notification_container").addClass('popup');
return false;
});

$(document).click(function(e) {
if (!$(e.target).closest('.popup').length){
$(".popup").hide();
}	
});


/* Link Preview */
if($('#status_post').length > 0){
$('#status_post').linkPreview();
}
$("#text_status_post").charCounter(144,{container: "#char-left"});

/* File Uploader */


if(typeof Croppic !== 'undefined'){
// Upload Avatar
var croppic_avatar_options = {
processInline:true,
cropUrl: base_url + '/ajax/avatar',
customUploadButtonId: 'upload_avatar',
modal: false,
loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
onError: function(errormessage){ console.log('onError:'+errormessage) }
}
var croppic_avatar = new Croppic('profile_img', croppic_avatar_options);

// Upload Cover
var croppic_cover_options = {
processInline:true,
cropUrl: base_url + '/ajax/cover',
modal: false,
loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
onError: function(errormessage){ console.log('onError:'+errormessage) }
}
var croppic_cover = new Croppic('cover', croppic_cover_options);
}










if(typeof Dropzone !== 'undefined'){
Dropzone.autoDiscover = false;	
$("#compose-photo").dropzone({
paramName: "file",
hiddenInputContainer: "#file-uploader .addfile",
autoProcessQueue: false,
addRemoveLinks : true,
renderMethod: "prepend",
dictDefaultMessage: "Add Photo",
previewsContainer: "#file-uploader",
clickable : "#file-uploader .addfile",
previewTemplate: "<div class=\"pic dz-preview dz-file-preview\">\n  <div class=\"dz-image\"><img data-dz-thumbnail /></div>\n  <div class=\"dz-details\">\n    <div class=\"dz-size\"><span data-dz-size></span></div>\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n  </div>\n  <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n  <div class=\"dz-success-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Check</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n<path d=\"M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" stroke-opacity=\"0.198794158\" stroke=\"#FFFFFF\" fill-opacity=\"0.816519475\" fill=\"#32A336\" sketch:type=\"MSShapeGroup\"></path>\n      </g>\n    </svg>\n  </div>\n  <div class=\"dz-error-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Error</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n<g id=\"Check-+-Oval-2\" sketch:type=\"MSLayerGroup\" stroke=\"#FFFFFF\" stroke-opacity=\"0.198794158\" fill=\"#ff0000\" fill-opacity=\"0.816519475\">\n  <path d=\"M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" sketch:type=\"MSShapeGroup\"></path>\n</g>\n      </g>\n    </svg>\n  </div>\n</div>",
RemoveLinkTemplate: "<div class=\"remove\" data-dz-remove><i class=\"icon-cross\"></i></div>",

init: function() {
var submitButton = document.querySelector("#post-create .post-btn");
myDropzone = this; // closure

submitButton.addEventListener("click", function() {
myDropzone.processQueue(); // Tell Dropzone to process all queued files.
});

}
});

// Album
$("#add-photos-box").dropzone({
paramName: "files",
hiddenInputContainer: "#file-uploader .addfile",
autoProcessQueue: false,
addRemoveLinks : true,
renderMethod: "prepend",
dictDefaultMessage: "Add Photo",
previewsContainer: "#file-uploader",
clickable : "#file-uploader .addfile",
previewTemplate: "<div class=\"pic dz-preview dz-file-preview\">\n  <div class=\"dz-image\"><img data-dz-thumbnail /></div>\n  <div class=\"dz-details\">\n    <div class=\"dz-size\"><span data-dz-size></span></div>\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n  </div>\n  <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n  <div class=\"dz-success-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Check</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n<path d=\"M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" stroke-opacity=\"0.198794158\" stroke=\"#FFFFFF\" fill-opacity=\"0.816519475\" fill=\"#32A336\" sketch:type=\"MSShapeGroup\"></path>\n      </g>\n    </svg>\n  </div>\n  <div class=\"dz-error-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Error</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n<g id=\"Check-+-Oval-2\" sketch:type=\"MSLayerGroup\" stroke=\"#FFFFFF\" stroke-opacity=\"0.198794158\" fill=\"#ff0000\" fill-opacity=\"0.816519475\">\n  <path d=\"M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" sketch:type=\"MSShapeGroup\"></path>\n</g>\n      </g>\n    </svg>\n  </div>\n</div>",
RemoveLinkTemplate: "<div class=\"remove\" data-dz-remove><i class=\"icon-cross\"></i></div>",

init: function() {
var submitButton = document.querySelector("#process");
myDropzone = this; // closure
submitButton.addEventListener("click", function(e) {
e.preventDefault();
e.stopPropagation();	
myDropzone.processQueue(); // Tell Dropzone to process all queued files.
});

this.on("complete", function(file, responseText) {
	
setTimeout(function(){ $('div.dz-success').remove(); }, 5000);
});
}
});

/*
$("#profile_img").dropzone({
paramName: "file",
thumbnailWidth: 200,
thumbnailHeight: 200,
url: base_url + "/ajax/avatar",
dictDefaultMessage: "Change Avatar",
hiddenInputContainer: "#upload_avatar",
addRemoveLinks : true,
previewsContainer: "#profile_img",
clickable : "#upload_avatar",
previewTemplate: "<div class=\"dropzone add-avatar dz-preview dz-file-preview\">\n  <div class=\"dz-image\"><img class=\"img-thumbnail\" data-dz-thumbnail /></div>\n  <div class=\"dz-details\">\n    <div class=\"dz-size\"><span data-dz-size></span></div>\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n  </div>\n  <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n  <div class=\"dz-success-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Check</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n<path d=\"M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" stroke-opacity=\"0.198794158\" stroke=\"#FFFFFF\" fill-opacity=\"0.816519475\" fill=\"#32A336\" sketch:type=\"MSShapeGroup\"></path>\n      </g>\n    </svg>\n  </div>\n  <div class=\"dz-error-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Error</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n<g id=\"Check-+-Oval-2\" sketch:type=\"MSLayerGroup\" stroke=\"#FFFFFF\" stroke-opacity=\"0.198794158\" fill=\"#ff0000\" fill-opacity=\"0.816519475\">\n  <path d=\"M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" sketch:type=\"MSShapeGroup\"></path>\n</g>\n      </g>\n    </svg>\n  </div>\n</div>",
RemoveLinkTemplate: "<div class=\"remove\" data-dz-remove><i class=\"icon-cross\"></i></div>",
init: function() {
this.on("success", function(file, responseText) {
$("img.avatar").attr("src", responseText.avatar);
});
this.on("complete", function(file, responseText) {
	
setTimeout(function(){ $('div.dz-success').remove(); }, 5000);
});

}
});


$("#cover-pic").dropzone({
paramName: "file",
thumbnailWidth: 1125,
thumbnailHeight: 300,
hiddenInputContainer: "#file-uploader .addfile",
autoProcessQueue: false,
addRemoveLinks : true,
renderMethod: "prepend",
dictDefaultMessage: "Add Photo",
previewsContainer: "#file-uploader",
clickable : "#file-uploader .addfile",
previewTemplate: "<div class=\"pic dz-preview dz-file-preview\">\n  <div class=\"dz-image\"><img data-dz-thumbnail /></div>\n  <div class=\"dz-details\">\n    <div class=\"dz-size\"><span data-dz-size></span></div>\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n  </div>\n  <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n  <div class=\"dz-success-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Check</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n<path d=\"M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" stroke-opacity=\"0.198794158\" stroke=\"#FFFFFF\" fill-opacity=\"0.816519475\" fill=\"#32A336\" sketch:type=\"MSShapeGroup\"></path>\n      </g>\n    </svg>\n  </div>\n  <div class=\"dz-error-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Error</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n<g id=\"Check-+-Oval-2\" sketch:type=\"MSLayerGroup\" stroke=\"#FFFFFF\" stroke-opacity=\"0.198794158\" fill=\"#ff0000\" fill-opacity=\"0.816519475\">\n  <path d=\"M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" sketch:type=\"MSShapeGroup\"></path>\n</g>\n      </g>\n    </svg>\n  </div>\n</div>",
RemoveLinkTemplate: "<div class=\"remove\" data-dz-remove><i class=\"icon-cross\"></i></div>",
init: function() {
var submitButton = document.querySelector("#twitter");
myDropzone = this; // closure

submitButton.addEventListener("click", function() {
myDropzone.processQueue(); // Tell Dropzone to process all queued files.
});
}
});
*/

}

// Post Tweet
var msg = $('#message');
$("#compose").ajaxForm({
beforeSend: function() {
msg.empty();
$(".post-indicator").show();
},
success: function(obj) {
	
var msg_content = obj.msg;

var html_body_success = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><span class='glyphicon glyphicon-remove'></span>"+ msg_content +"</div>";

var html_body_error = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><span class='glyphicon glyphicon-remove'></span>"+ msg_content +"</div>";

if(obj.success){
msg.html(html_body_success);

$('#twitter-post').clearInputs();
$("#twitter").attr("disabled", true);
} else {
msg.html(html_body_error);
}

$('div.dz-success').remove();

$(".post-indicator").hide();

},
error: function(xhr){
msg.html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><span class='glyphicon glyphicon-remove'></span>Something is wrong. Please try again later.</div>");

$('div.dz-success').remove();

$(".post-indicator").hide();
}
});




var suggestData = {};

suggestData['@'] = {
data: function(q) {
if (q && q.length > 1) {
return $.post(base_url + "/ajax/suggest", { q:q });
}
},
map: function(user) {
return { value: user.user_name, text: '<strong>@'+user.user_name+'</strong><small> '+user.display_name+'</small>' }
}
}

suggestData[':'] = {
data: function(q) {
if (q && q.length > 1) {
return $.getJSON(base_url + "/ajax/emoji");
}
},
map: function(emoji) {
return { value: emoji.value, text: '<span class="twa twa-lg twa_'+emoji.code+'"></span> <strong>'+emoji.text+'</strong> ' }
}
}

$('textarea').on('focus', function() {
$(this).suggest(suggestData);
});

// Auto Check Notification
function auto_notification_check(){

$.getJSON(base_url+"/ajax/all_notification",function(data){

$.each(data.notification,function(index, value){

var template = template_notification(value);

$("#notifications_body").prepend(template);
});

$.each(data.messages,function(index, value){

$("#post-create").append(value.content);
});

$.each(data.friend_request,function(index, value){

$("#post-create").append(value.content);
});


});

}

// Template
function template_notification(data){
var html = "<div class=\"media\">";
html += "<div class=\"media-left cover\">";
html += "<img src=\"http://placehold.it/50x50\" class=\"media-object\"></div>";
html += "<div class=\"media-body\">";
html += data.content;
html += "<p class=\"media-footer\">";
html += "<i class=\"icon-clock\"></i>"+data.created_at+ "</p>";
html += "</div>";
html += "</div>";
return html;
}

// Template Friend Request
function template_request(data){
var html = "<div class=\"media\">";
html += "<div class=\"media-left cover\">";
html += "<img src=\"\" class=\"media-object\"></div>";
html += "<div class=\"media-body\">";
html += "<h1>"+data.user_name+"</h1>";
html += "</div>";
html += "<div class=\"media-right\"><a href=\"javascript:void(0)\" class=\"btn btn-sm btn-success\"><i class=\"icon-ok\"></i> Confirm</a></div>";
html += "<div class=\"media-right\"><a href=\"javascript:void(0)\" class=\"btn btn-sm btn-danger\"><i class=\"icon-cross\"></i> Delete</a></div>";
html += "</div>";
return html;
}
// Template Messages
function template_messages(data){
var html = "<div class=\"media\">";
html += "<div class=\"media-left cover\">";
html += "<img src=\"\" class=\"media-object\"></div>";
html += "<div class=\"media-body\">";
html += "<h1>"+data.user_name+"</h1>";
html += "</div>";
html += "<div class=\"media-right\"><a href=\"javascript:void(0)\" class=\"btn btn-sm btn-success\"><i class=\"icon-ok\"></i> Confirm</a></div>";
html += "<div class=\"media-right\"><a href=\"javascript:void(0)\" class=\"btn btn-sm btn-danger\"><i class=\"icon-cross\"></i> Delete</a></div>";
html += "</div>";
return html;
}

});

/* Show Quick Post Box */

function quick_post(showhide){
if(showhide == "show"){
document.getElementById('quick-tweet').style.display = 'block'; /* If the function is called with the variable 'show', show the login box */
}else if(showhide == "hide"){
document.getElementById('quick-tweet').style.display = 'none'; /* If the function is called with the variable 'hide', hide the login box */
$('#message').empty();
$('#twitter-post').clearInputs();
$('#chose-photo').clearInputs();
$("#twitter").attr("disabled", true);
} }

// Like Post
$(document).on('click','#like', function(e) {
if(!loggeed_in){
alert("Login to use This Feature.");
}
else {
var $this = $(this);
var id = $this.attr("rel");
var post_type = $this.attr("post_type");
$.post( base_url + "/ajax/like",{action:'like', user_id: user_id, post_id : id,post_type : post_type}, function( data ) {
$this.replaceWith(data);
}).fail(function(response) {
console.log(response.responseText);
});
}
});
// Unlike Post
$(document).on('click','#unlike', function(e) {
if(!loggeed_in){
alert("Login to use This Feature.");
}
else {
var $this = $(this);
var id = $this.attr("rel");
var post_type = $this.attr("post_type");
$.post( base_url + "/ajax/like",{action:'dislike', user_id: user_id, post_id : id,post_type : post_type}, function( data ) {
$this.replaceWith(data);
}).fail(function(response) {
console.log(response.responseText);
});
}
});

// Follow User
$(document).on('click','#follow-btn', function(e) {
if(!loggeed_in){
alert("Login to use This Feature.");
}
else {
var $this = $(this);
var id = $this.attr("rel");
$.post( base_url + "/ajax/follow",{action:'follow', uid: user_id, fid : id}, function( data ) {
$this.replaceWith(data);
});
}
});
// UnlFollow User
$(document).on('click','#unfollow-btn', function(e) {
var $this = $(this);
var id = $this.attr("rel");
$.post( base_url + "/ajax/follow",{action:'unfollow', uid: user_id, fid : id}, function( data ) {
$this.replaceWith(data);
});
});
