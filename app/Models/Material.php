<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// added
use Kyslik\ColumnSortable\Sortable;
use App\Models\MaterialFiles;

class Material extends Model
{
    use HasFactory, Sortable;
    protected $fillable=[
        'title',
        'description',
        'status',
        'created_by',
    ];
    
    protected $sortable=[
        'id',
        'title',
        'description',
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function materialFiles(){
        return $this->hasMany(MaterialFiles::class);
    }
}
