<?php
ob_start();


$token= "__BOTTOKEN__";
$X=new app\Bot($token);

$update=$X->DATA();





@$message = $update->message;      
@$from_id = $message->from->id;      
             


@$chat_id = $message->chat->id;

@$message_id = $message->message_id;
@$first_name = $message->from->first_name;
@$last_name = $message->from->last_name;
@$username = $message->from->username;
@$textmassage = $message->text;

$Dev = 460471140;


@$forward_from_chat = $update->message->forward_from_chat;
@$from_chat_id = $forward_from_chat->id;

@$firstcall = $update->callback_query->from->first_name;
@$usercall = $update->callback_query->from->username;
@$tc3 = $update->callback_query->message->chat->type;
@$msg_call_id = $update->callback_query->message->message_id;
@$chatid = $update->callback_query->message->chat->id;
@$fm = $update->callback_query->message->from->id;
@$gif_file = $update->message->document->file_name;
@$tc = $update->message->chat->type;
@$tc2 = $update->edited_message->chat->type;
@$namegroup = $update->message->chat->title;
@$newchatmemberid = $update->message->new_chat_member->id;
@$rt = $update->message->reply_to_message;

@$rtmsgid=$update->message->reply_to_message->message_id;


@$namegroup = $update->message->chat_title;
@$is_bot=$update->message->from->is_bot;

@$edit = $update->edited_message->text;

@$first_name3=$update->edited_message->from->first_name;
@$username3=$update->edited_message->from->username;
@$is_bot4=$update->edited_message->from->is_bot;
@$photo = $rt->photo;//انجام
@$forward = $rt->forward_from;//----مونده
@$video = $rt->video;//انجام
@$location = $rt->location;//انجام
@$sticker = $rt->sticker;//انجام
@$document = $rt->document;
@$contact = $rt->contact;
@$game = $rt->game;
@$music = $rt->audio;
@$gif = $rt->gif;
@$voice = $rt->voice;
if(isset($photo)){
	$afile_id=$photo->file_id;
	$afile_size=$photo->file_size;
}elseif(isset($video)){
	$afile_id=$video->file_id;
	$afile_size=$video->file_size;
}elseif(isset($sticker)){
	$afile_id=$sticker->file_id;
	$afile_size=$sticker->file_size;
}elseif(($document)){
	$afile_id=$document->file_id;
	$afile_size=$document->file_size;
}elseif(($music)){
	$afile_id=$music->file_id;
	$afile_size=$music->file_size;
}elseif(($gif)){
	$afile_id=$gif->file_id;
	$afile_size=$gif->file_size;
}elseif(($voice)){
	$afile_id=$voice->file_id;
	$afile_size=$voice->file_size;
}else{
	$afile_id="فایلی پیدا نشد";
    $afile_size=null;
}
if($from_id==$Dev and $textmassage=="!info"){
    chdir("../cache");
    $all=glob("*");
    $sizes=0;
    foreach($all as $one){
       $sizes+=filesize($one);
      
    }
     $X->SendMessage($chat_id,$sizes/(1024*1024*8)."MB");
}elseif($from_id==$Dev and $textmassage=="!clear"){
     chdir("../cache");
    $all=glob("*");
    $sizes=0;
    foreach($all as $one){
       unlink($one);
       $sizes+=filesize($one);
    }
    $X->SendMessage($chat_id,$sizes/(1024*1024*8)."MB");
}
 if($textmassage=="check" or $textmassage=="scan" or $textmassage=="اسکن" or $textmassage=="بازبینی"){

	if(!empty($rtmsgid) ){
	if($afile_id!="فایلی پیدا نشد"){
	     $X->Request("sendMessage",["chat_id"=>$chat_id,"text"=>"در حال بررسی..","parse_mode"=>"Markdown","reply_to_message_id"=>$rtmsgid]);
	    if($afile_size<=(32*1024*1024)){

			$url = json_decode(file_get_contents('http://api.telegram.org/bot'.$token.'/getFile?file_id='.$afile_id),true);
			$path=$url['result']['file_path'];
			$file = 'http://api.telegram.org/file/bot'.$token.'/'.$path;
 
 			$photo=file_get_contents("./example/file.php?url=$file");
 	
			 $X->Request("sendPhoto",["chat_id"=>$chat_id,"photo"=>"./cache/$photo.png","reply_to_message_id"=>$rtmsgid]);
			 echo time();
			 
		}else{
			// $X->Request("deletemessage",["chat_id"=>$chat_id,"message_id"=>$msg_id]);
			 $X->Request("sendMessage",["chat_id"=>$chat_id,"text"=>"حجم فایل بیش از 32 مگابایت است","parse_mode"=>"Markdown","reply_to_message_id"=>$rtmsgid]);
		}
		//file
		 //$Bot->Request("deletemessage",["chat_id"=>$chat_id,"message_id"=>$msg_id]);
		
	}else{
		//reply_to_message_id
		 $X->Request("sendMessage",["chat_id"=>$chat_id,"text"=>$afile_id,"parse_mode"=>"Markdown","reply_to_message_id"=>$rtmsgid]);

	}
	}
}

