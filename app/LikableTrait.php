<?php

namespace App;


trait LikableTrait
{

    public function likes()
    {
        return $this->morphMany(Like::class,'likable')/*->latest()*/;
    }


    public function likeIt()
    {
        $like=new Like();
        $like->user_id=auth()->user()->id;

        $this->likes()->save($like);

        return $like;
    }

    public function unlikeIt()
    {
/*        $like=Like::find($id);
        $like->delete();*/
        $like=$this->likes()->where('user_id', auth()->id())->delete();

        return true;
    }

    public function isLiked()
    {
         return !!$this->likes()->where('user_id', auth()->id())->count();
    }

}
