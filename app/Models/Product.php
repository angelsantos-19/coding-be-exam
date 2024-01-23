<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'datetime',
        'image'
    ];

    public function scopeFilter($query, array $filters){

        if($filters['search'] ?? false){
            $query->where('name','like','%'.request('search').'%')
            ->orWhere('category','like','%'.request('search').'%');
        }
        if($filters['filter'] ?? false){
            $query->Where('category','like','%'.request('filter').'%');
        }
    }
}
