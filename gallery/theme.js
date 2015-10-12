jQuery(document).ready( function() {
var helper=BpGalleryHelper;
var j = jQuery;
//j(".activity audio").each(function (){
   // alert("yep");
   j(".activity audio").css({width:'310px'}); 
//});
/**
 *  TODO: Minimize dependency of Dom elements by Id, as much as possible
 */
//basic setup
//if the file element exists activate swf uploader
if(j("#file").get(0)&&helper.is_flash_enabled())//just to avoid the conflict
    swfuplod_init_for_media("file");

//see above line, activate swf upload for cover upload in case we are opening directly the cover upload page for gallery
if(j("#cover_file").get(0)&&helper.is_flash_enabled())
   swfuplod_init_for_gallery("cover_file");


//global variables,bad thing but required
gallery_upload_error=false;//handling upload errors
gallery_upload_error_message='';//in next version, we will use it as an array of errors


/*
 *--------------------------- File Upload functions for swf upload ------------------------------------*
 *-----------------------------------------------------------------------------------------------------*
 **/

/*************************************************************** SWF Upload Helper Functions *************************************/

/* Generic functions like queueing, handling queue error etc*/
// Handles Listing of files, just a UI function, It lists the file when file is selected in the DOM

function file_queued(event, file){
    var listitem='<li id="'+file.id+'" >'+
                    'File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB) <span class="progressvalue" ></span>'+
                    '<div class="progressbar" ><div class="progress" ></div></div>'+
                    '<p class="status" >Pending</p>'+
                     '<span class="cancel" >&nbsp;</span>'+
                '</li>';
	j('#log').append(listitem);
	j('li#'+file.id+' .cancel').bind('click', function(){

        var swfu = j.swfupload.getInstance('#swfupload-control');
	swfu.cancelUpload(file.id);
	j('li#'+file.id).slideUp('fast');
			});

}

//Handle the uploading error, i.e basic client side error handing by swf
function file_queue_error( file, errorCode, message){
    helper.show_message('Size of the file '+file.name+' is greater than limit'+message,1);//notify the error to the user
}

//Update the Number of file selected etc when File dialog is complete/closed

function file_dialog_complete(event, numFilesSelected, numFilesQueued){
    j('#queuestatus').text('Files Selected: '+numFilesSelected+' / Queued Files: '+numFilesQueued);
}

// helper function, called when swfupload starts uploading
function upload_start(event, file){
    j('#log li#'+file.id).find('p.status').text('Uploading...');
    j('#log li#'+file.id).find('span.progressvalue').text('0%');
    j('#log li#'+file.id).find('span.cancel').hide();
    j(".guploading").show();//show the progress icon

}
//Helper function to handle the upload progress and show user the progress

function upload_progress(event, file, bytesLoaded){
    //Show Progress
    var percentage=Math.round((bytesLoaded/file.size)*100);
    j('#log li#'+file.id).find('div.progress').css('width', percentage+'%');
    j('#log li#'+file.id).find('span.progressvalue').text(percentage+'%');
}



/**
 * @desc helper function used to remove file from the list of selectd files on error/success
 */
function remove_file_from_list(file){
      var item=j('#log li#'+file.id);
          item.find('div.progress').css('width', '100%');
          item.find('span.progressvalue').text('100%');
	  item.addClass('success').find('p.status').html('Done!!!');
	  j(item).remove();//remove the file listing from dom
}


/**
 * Helper function for gallery cover upload complete
 * *
 */
function gallery_upload_complete(event, file){
    var swfu = j.swfupload.getInstance('#swfupload-control');
    j('li#'+file.id).slideUp('fast');
    j(".guploading").hide();
}
/**
 * @desc  Helper functuion, used when a gallery save is clicked and response is recieved from server
 */
function gallery_upload_success(event, file, serverData){
    //alert(serverData)
    var resp=JSON.parse( serverData);
      if(resp.data)
           helper.show_message(resp.data.msg);// show update
      else
         helper.show_message(resp.error.msg,1);

      remove_file_from_list(file);
}





//For Media
//Helper function for swfupload, called when a file upload is complete

function media_upload_complete(event, file){
    var swfu = j.swfupload.getInstance('#swfupload-control');
    j('li#'+file.id).slideUp('fast');
            // upload has completed, try the next one in the queue
    var stats=swfu.getStats();
    if(stats.files_queued!=0)
      j(this).swfupload('startUpload');
    else{
        j(".guploading").hide();//show the progress icon
         //simulate a click on the other tab
         //check for upload errors , if none
         if(!gallery_upload_error)
            j("#gallery-media-edit").click();//simulate click, let us see
         else {
                helper.show_message(gallery_upload_error_message,1);
                 //reset error message
                 gallery_upload_error_message='';
                 gallery_upload_error=false;
             }
      }
}

//Helper function, used when a media is uploaded and saved
function media_upload_success(event, file, serverData){
    //alert(serverData);
    //alert(serverData);
    resp=JSON.parse(serverData);
    if(resp.data)
         j("#update_media_upload").prepend(helper.build_media_html(resp.data));
    else{
        helper.show_message(resp.error.msg,1);//notify the error
        gallery_upload_error=true;
        gallery_upload_error_message=resp.error.msg;
        }
    remove_file_from_list(file);
}

function activity_upload_success(event, file, response){
    //alert(serverData);
   //it should be simply activity update function
    var form=j("#whats-new-form");
    j( 'form#' + form.attr('id') + ' span.ajax-loader' ).hide();
      /* Check for errors and append if found. */
	if ( response[0] + response[1] == '-1' ) {
		form.prepend( response.substr( 2, response.length ) );
		jq( 'form#' + form.attr('id') + ' div.error').hide().fadeIn( 200 );
		button.attr("disabled", '');
            } else {
                	if ( 0 == j("ul.activity-list").length ) {
			j("div.error").slideUp(100).remove();
			j("div#message").slideUp(100).remove();
			j("div.activity").append( '<ul id="activity-stream" class="activity-list item-list">' );
			}

		j("ul.activity-list").prepend(response);
		j("ul.activity-list li:first").addClass('new-update');
		j("li.new-update").hide().slideDown( 300 );
		j("li.new-update").removeClass( 'new-update' );
		j("textarea#whats-new").val('');
        	}



    remove_file_from_list(file);
    //hide the form
    j("#whats-new-options form").remove();
}

function activity_upload_complete(event, file){
   // alert("yes yes");
    var swfu = j.swfupload.getInstance('#swfupload-control');
    j('li#'+file.id).slideUp('fast');
            // upload has completed, try the next one in the queue
   j(".guploading").hide();//show the progress icon

    if(!gallery_upload_error){
            j("#gallery-media-edit").click();//simulate click, let us see
    }
    else {
                helper.show_message(gallery_upload_error_message,1);
                 //reset error message
                 gallery_upload_error_message='';
                 gallery_upload_error=false;
             }

}



/**
 * @desc Populate parameters for media upload
 * */
function populate_post_params_for_media(){
  var swfu = j.swfupload.getInstance('#swfupload-control');
    swfu.addPostParam("action","save_gallery_media_bulk");
    swfu.addPostParam("cookie",encodeURIComponent(document.cookie));
    swfu.addPostParam("user-galleries",j("#gallery_media_upload_form #galleries-list").val());
    swfu.addPostParam("_wpnonce",j("input#_wpnonce-save-gallery-image").val());
    swfu.addPostParam("component_type",cur_component);
    swfu.addPostParam("component_id",cur_component_id);
}


function populate_post_params_for_activity(){
  var swfu = j.swfupload.getInstance('#swfupload-control');
    swfu.addPostParam("action","upload_from_activity");
    swfu.addPostParam("cookie",encodeURIComponent(document.cookie));
    swfu.addPostParam("user-galleries",j("#gallery_media_upload_form #galleries-list").val());
    swfu.addPostParam("_wpnonce",j("input#_wpnonce-save-gallery-image").val());
    swfu.addPostParam("component_type",cur_component);
    swfu.addPostParam("component_id",cur_component_id);
    swfu.addPostParam("comment_text",j("#whats-new").val());
}
/**
 * @desc Initialize swfuploader on an element
 */
function swfuplod_init(id){
    gallery_upload_settings.button_placeholder_id=id;
    guploader=j('#swfupload-control').swfupload(gallery_upload_settings);//instantiate
    guploader.bind("fileQueued",file_queued);
    guploader.bind("fileQueueError",file_queue_error);
    guploader.bind("fileDialogComplete",file_dialog_complete);
    guploader.bind("uploadStart",upload_start);
    guploader.bind("uploadProgress",upload_progress);

}

function  swfuplod_init_for_gallery(id){
     swfuplod_init(id);
     guploader.bind("uploadComplete",gallery_upload_complete);
     guploader.bind("uploadSuccess", gallery_upload_success);//associate a upload success handler function
}


function  swfuplod_init_for_media(id){
    swfuplod_init(id);
    guploader.bind("uploadComplete",media_upload_complete);
    guploader.bind("uploadSuccess", media_upload_success);
}

function  swfuplod_init_for_activity(id){

   // gallery_upload_settings.file_upload_limit=2;
    gallery_upload_settings.file_upload_limit=1;
    swfuplod_init(id);
     //var swfu = j.swfupload.getInstance('#swfupload-control');
    guploader.unbind("fileQueueError",file_queue_error);
    guploader.bind("fileQueueError",function(){
            helper.show_message("Please cancel the queued media to select new",1);
            });

    guploader.bind("uploadComplete",activity_upload_complete);
    guploader.bind("uploadSuccess", activity_upload_success);
}


//end of upload helper
/**
 * @desc Load the Media Upload form*/
j(".gallery-actions a.upload, #upload_media_link,#gallery_media_upload").live('click',
    function() {
        var url = j(this).attr('href');
        var gid=helper.get_var_in_url(url,'gallery_id');
	var nonce = helper.get_nonce(url);
	j.post( ajaxurl, {
                            action: 'show_gallery_media_upload_form',
			    'cookie': encodeURIComponent(document.cookie),
                            'gallery_id':gid,
                            '_wpnonce': nonce
			},
		function(response){
                       var p="#galleries";
			j(p).fadeOut(200,
                            function() {
                                j(p).html(response);//do not prepend just remove the all other things
                                if(helper.is_flash_enabled())
                                    swfuplod_init_for_media("file");
				j(p).fadeIn(200);//wp3//j('form#gallery_media_upload_form')
                                j.scrollTo( j(p), 500, {offset:-50, easing:'easeOutQuad'} );
                	 }
			);

		});

	return false;
});


//cover upload form
j("#gallery_gallery_cover_upload").live('click',
    function() {
        var url = j(this).attr('href');
        var gid=helper.get_var_in_url(url,'gallery_id');
	var nonce = helper.get_nonce(url);
	j.post( ajaxurl, {
                            action: 'show_gallery_cover_upload_form',
			    'cookie': encodeURIComponent(document.cookie),
                            'gallery_id':gid,
                            '_wpnonce': nonce
			},
		function(response){
                       var p="#galleries";
			j(p).fadeOut(200,
                            function() {
                                j(p).html(response);//do not prepend just remove the all other things
                                if(helper.is_flash_enabled())
                                    swfuplod_init_for_gallery("cover_file");//activate swfupload only if flash is enabled
				j(p).fadeIn(200);//wp3//j('form#gallery_cover_upload_form')
                                j.scrollTo( j(p), 500, {offset:-50, easing:'easeOutQuad'} );
                	 }
			);

		});

	return false;
});



/*** dropped for stable******/
//a;llow uploading from activity

j("#gallery_upload_buttons_for_activity a").live('click',
    function() {
        var el=j(this);
        j("#gallery_media_upload_form").remove();
        var type=j(this).attr("id");//use id as type detector , may be photo/audio/video

	j.post( ajaxurl, {
                            action: 'show_gallery_media_upload_form_activity',
			    'cookie': encodeURIComponent(document.cookie),
                            'gallery_type':type,

                            '_wpnonce': "nonce"
			},
		function(response){
                       var container=j(el).parent().parent();//whats new options
                       j(container).fadeOut(200,
                            function() {
                                j(container).append(response);//do not prepend just remove the all other things
                                if(helper.is_flash_enabled())
                                    swfuplod_init_for_activity("file");
				j(container).fadeIn(200); //wp3
                                j.scrollTo( j('form#gallery_media_upload_form'), 500, {offset:-50, easing:'easeOutQuad'} );
                	 }
			);

		});

	return false;
});
/** Save gallery Cover Image**/
j("#save_gallery_cover").live('click',function(){
    if(!helper.is_flash_enabled())
        return ;
     var swfu = j.swfupload.getInstance('#swfupload-control');
         swfu.addPostParam("action","save_gallery_cover");
         swfu.addPostParam("cookie",encodeURIComponent(document.cookie));
         swfu.addPostParam("gallery_id",j("#gallery_cover_upload_form #gallery_id").val());
         swfu.addPostParam("_wpnonce",j("input#_wpnonce-save-gallery-cover").val());

       // populate_post_params_for_media();//populate the post parameters
         guploader.swfupload('startUpload');
        return false;


});


/**
 * @desc Bulk Media Upload Handling
 */
j("#bulk_upload_media_submit").live('click',
		function() {

       if(helper.is_flash_enabled()){
        populate_post_params_for_media();//populate the post parameters
         guploader.swfupload('startUpload');
         return false;
       }
     
});

//add from web
j("#gallery_save_from_web").live("click",function(){
j(".guploading").show();//show loading icon
var web_link=j("#gallery_web_url").val();

var gid=j("#galleries-list").val();
var media_status=j("#gallery_status").val();
var nonce=j("#_wpnonce-save-gallery-media-from-web").val();
j("#gallery_save_from_web").attr('disabled','disabled');
j.post( ajaxurl, {
                            action: 'add_gallery_media_form_web',
                            'url':web_link,
			    'cookie': encodeURIComponent(document.cookie),
                            'gallery_id':gid,
                            'media_status':media_status,
                           '_wpnonce': nonce
			},
		function(response){
                   // alert("result");
                    //alert(response);
                       //show response
                        j("#update_media_upload").prepend(response);
                        j(".guploading").hide();//hide loading icon
                        j("#gallery_save_from_web").attr("disabled",'');
                        j("#gallery_web_url").val('');
		});


return false;
    
})

j("#activity_upload_media_submit").live("click",function(){

if(helper.is_flash_enabled()){
    populate_post_params_for_activity();//populate the post parameters
         guploader.swfupload('startUpload');
        return false;
}


});//end of activity upload section
//set audios width as from css



 jQuery('video,audio').mediaelementplayer({audioWidth:-1});
    jQuery(".activity-inner .mejs-container").each(function(i,el){
    if( jQuery(el).find('audio' ).get(0))
        jQuery(el).addClass('bp-gallery-audio');
    
     //   jQuery(".mejs-container",jQuery(this)).addClass('bp-gallery-audio');
});
});
//global function
function gallery_activate_player(){
    jQuery('div.activity video,div.activity audio').mediaelementplayer({audioWidth:-1});
    jQuery(".activity-inner .mejs-container").each(function(i,el){
    if( jQuery(el).find('audio' ))
        jQuery(el).addClass('bp-gallery-audio');
    
     //   jQuery(".mejs-container",jQuery(this)).addClass('bp-gallery-audio');
});
 }

function gallery_activate_player_on_organize(){
    
    jQuery('div.media-cover video,div.media-cover audio').mediaelementplayer({audioWidth:-1});
 }

