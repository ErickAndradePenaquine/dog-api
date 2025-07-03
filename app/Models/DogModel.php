<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

class DogModel extends Model
{

    protected $table = 'dog';

    protected $fillable = ['nome', 'raca', 'idade'];

    public $timestamps = true;//automatico
}

