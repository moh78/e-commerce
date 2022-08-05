<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'phone',
        'phone2',
        'email',
        'address',
        'map',
        'twiter',
        'facebook',
        'pinterest',
        'instagram',
        'youtube',
    ];
}
