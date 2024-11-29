<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    //define table name and primary key
    protected $table='categories';
    protected $primaryKey='cid';
}
