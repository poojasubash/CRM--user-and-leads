<?php

namespace App\Models;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $fillable=[
        'description'
    ];
    public function leads()
    {
        return $this->belongsToMany(Lead::class);
    }
}
