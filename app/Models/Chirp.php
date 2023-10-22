<?php

namespace App\Models;

use App\Events\ChirpCreated;
use App\Events\ChirpDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
    ];

    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
        'deleted' => ChirpDeleted::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
