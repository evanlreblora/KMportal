<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GOFBudget extends Model
{
    use HasFactory;
      protected $fillable = ['filename','desc','unit','type','uploader','filepath'];

    
    public $table = 'gofbudget';
    protected $guarded = [];
}
