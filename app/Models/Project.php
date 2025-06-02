<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_started',
        'date_finished',
        'description',
        'responsible_id',
        'responsible_type',
        'is_activated'
    ];

    protected $casts = [
        'date_started' => 'date',
        'date_finished' => 'date',
        'is_activated' => 'boolean',
    ];

    public function responsible(): MorphTo
    {
        return $this->morphTo();
    }

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Pessoa::class, 'person_project')
                    ->withPivot('is_volunteer')
                    ->withTimestamps();
    }

    public function volunteers()
    {
        return $this->people()->wherePivot('is_volunteer', 1);
    }

    public function nonVolunteers()
    {
        return $this->people()->wherePivot('is_volunteer', 0);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
                    ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('is_activated', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_activated', 0);
    }

    public function isActive(): bool
    {
        return $this->is_activated;
    }

    public function isFinished(): bool
    {
        return !is_null($this->date_finished) && now()->greaterThanOrEqualTo($this->date_finished);
    }

    public function isOngoing(): bool
    {
        return !$this->isFinished() && $this->isActive();
    }
}
