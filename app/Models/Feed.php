<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// added
use Kyslik\ColumnSortable\Sortable;
use App\Models\FeedFiles;

class Feed extends Model
{
    use HasFactory, Sortable;
    protected $fillable=[
        'title',
        'description',
        'cover',
        'type',
        'exp_date',
        'status',
        'created_by',
    ];

    protected $sortable=[
        'id',
        'title',
        'description',
        'cover',
        'type',
        'exp_date',
        'created_at',
        'status',
        'created_by',
    ];

    public function feedFiles(){
        return $this->hasMany(FeedFiles::class);
    }
}
