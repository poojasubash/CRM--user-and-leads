<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Group;
use App\Models\Source;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'country_code',
        'phone',
        'status',
        'source_id',
        'group_id',
    ];
    // Lead.php
    public function source()
    {
        return $this->belongsTo(Source::class,'source_id');
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
