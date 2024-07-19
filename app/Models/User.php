<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the questions made by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get the responses made by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    /**
     * Get the actions made by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    /**
     * Get the assessments made by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * Get the log entries made by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logEntries(): HasMany
    {
        return $this->hasMany(LogEntry::class);
    }

    /**
     * Get the attachments made by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
}
