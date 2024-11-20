<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courrier extends Model
{
    use HasFactory;
    protected $table = 'courrier';
    protected $fillable=['type','date','destinataire','expediteur','description','image'

    ];
    protected $casts = [
        'date' => 'datetime',
    ];

}
