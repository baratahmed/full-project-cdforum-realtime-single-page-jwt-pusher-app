<?php

namespace App\Model;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function($question){
            $question->question_slug = Str::slug($question->question_title);
        });
    }

    protected $with = ['replies'];

    public function getRouteKeyName(){
        return 'question_slug';
    }
    public function getPathAttribute(){
        return "/question/$this->question_slug";
    }
    
    //protected $guarded = [];

    protected $fillable = ['question_title','question_slug','question_body','category_id','user_id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    } 
    public function replies(){
        return $this->hasMany(Reply::class)->latest();
    } 
    public function category(){
        return $this->belongsTo(Category::class);
    } 
}
