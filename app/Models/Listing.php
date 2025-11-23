<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'tags',
        'company',
        'location',
        'email',
        'website',
        'description',
        'logo',
    ];
    public function scopeFilter($query , array $filters){
      if($filters["tag"] ?? false){
        $query->where("tags" , "like" ,"%" .request("tag"). "%");
      }
      if($filters["search"] ?? false){
        $query->where(function($query) {
          $query->where("title" , "like" ,"%" .request("search"). "%")
          ->orWhere("company" , "like" ,"%" .request("search"). "%")
          ->orWhere("location" , "like" ,"%" .request("search"). "%")
          ->orWhere("tags" , "like" ,"%" .request("search"). "%")
          ;
        });
      }
    }
}

