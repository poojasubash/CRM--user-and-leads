<?php

namespace App\Models;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Source extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',

    ];
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
