<?php

namespace App;


trait CommentableTrait
{

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable')/*->latest()*/;
    }


    public function addComment($body)
    {
        //Handle File Upload
        if($body->hasFile('cover_image')){
            //Get filename with the extension
            $filenameWithExt = $body->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename =pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get Ext
            $extension = $body->file('cover_image')->getClientOriginalExtension();
            //Filename store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $body->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }


        $comment=new Comment();
        $comment->body=$body->body;
        $comment->cover_image=$fileNameToStore;
        $comment->user_id=auth()->user()->id;

        $this->comments()->save($comment);

        return $comment;
    }

}
