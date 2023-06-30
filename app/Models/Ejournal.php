<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejournal extends Model
{
    use HasFactory;

    protected $table = 'link_ejournal';

    protected $guarded = ['id'];
}
