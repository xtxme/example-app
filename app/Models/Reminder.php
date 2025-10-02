<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['title','remind_at','status','user_id', /* ฯลฯ */];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    // ถ้าจำเป็น: relation กับ user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'remind_at' => 'datetime',
    ];

    public function getStatusLabelAttribute()
    {
        return $this->status ?: 'New';
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->status)) {
                $model->status = 'New';
            }
        });
    }
        
}
