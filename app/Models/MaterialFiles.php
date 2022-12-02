<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// added
use App\Models\Material;

class MaterialFiles extends Model
{
    use HasFactory;
    protected $fillable=[
    'file',
    'file_title',
    'file_description',
    'file_status',
    'material_id',
    ];

    public function materials(){
        return $this->belongsTo(MaterialFiles::class);
    }
}
