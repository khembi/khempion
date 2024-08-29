<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Action extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'response_id',
        'action_type',
        'action',
        'meta',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * Get the user that owns the response.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the response that owns the action.
     */
    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }

    /**
     * Get the assessments for the action.
     */
    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * Get all of the action's attachments.
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * Get all of the action's log entries.
     */
    public function logEntries(): MorphMany
    {
        return $this->morphMany(LogEntry::class, 'loggable');
    }
}
