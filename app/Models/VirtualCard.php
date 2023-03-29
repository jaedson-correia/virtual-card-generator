<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;

class VirtualCard extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [''];
}
