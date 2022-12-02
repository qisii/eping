<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// added
use App\Models\Feed;

class FeedFiles extends Model
{
    use HasFactory;
    protected $fillable=[
        'file',
        'feed_id',
    ];

    public function feeds(){
        return $this->belongsTo(FeedFiles::class);
    }
}
