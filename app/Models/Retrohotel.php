<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retrohotel extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'logo_url', 'background_url', 'user_count', 'hotel_link', 'is_retro_of_the_month', 'maintenance_mode'];
}
