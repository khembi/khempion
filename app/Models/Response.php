<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Response extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'question_id',
        'response',
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
     * Get the question that owns the response.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the actions for the response.
     */
    public function actions(): HasMany
    {
        return $this->hasMany(Action::class);
    }

    /**
     * Get all of the response's attachments.
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * Get all of the response's log entries.
     */
    public function logEntries(): MorphMany
    {
        return $this->morphMany(LogEntry::class, 'loggable');
    }
}
