<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'users_id',
        'name',
        'phone_number',
        'category',
    ];

    public function products(){
        return $this->hasMany(Product::class,'shops_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'users_id','id');
    }

}
