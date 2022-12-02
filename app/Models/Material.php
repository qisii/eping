<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// added
use App\Models\MaterialFiles;

class Material extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'status',
        'created_by',
    ];

    public function materialFiles(){
        return $this->hasMany(MaterialFiles::class);
    }
}
