<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description', 
        'incident_type', 
        'latitude', 
        'longitude', 
        'image_path',
        'response_status', 
        'legitimacy',
        'created_at',
        'updated_at'];



    protected $sortable = [
        'id',
        'description', 
        'incident_type', 
        'latitude', 
        'longitude', 
        'image_path', 
        'response_status',
        'legitimacy',
        'created_at',
        'updated_at'];
}
