<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Assessment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action_id',
        'admin_id',
        'assessment',
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the owning assessable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function assessable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get all of the assessment's attachments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * Get all of the assessment's log entries.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function logEntries(): MorphMany
    {
        return $this->morphMany(LogEntry::class, 'loggable');
    }
}
