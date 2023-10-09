<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $table='restaurants';
    protected $primaryKey='id';
    protected $fillable=['name', 'address', 'phone', 'created_at', 'updated_at'];
    protected $guarded=[];
    public $timestamps=true;
}
