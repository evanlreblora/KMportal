<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BIMworkshopFiles extends Model
{
    use HasFactory;
    protected $fillable = ['filename','desc','unit','type','uploader','filepath'];

    
    public $table = 'bimworkshop';
    protected $guarded = [];
}
