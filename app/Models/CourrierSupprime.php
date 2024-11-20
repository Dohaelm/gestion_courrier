<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourrierSupprime extends Model
{
    use HasFactory;
    protected $table = 'courrier_supprime';
    protected $fillable=['type','date','destinataire','expediteur','description','image','motif_de_suppression'];
    protected $casts = [
        'date' => 'datetime',
    ];
}
