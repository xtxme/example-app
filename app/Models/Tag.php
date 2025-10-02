<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 class Tag extends Model
 {
     protected $fillable = ['name']; // Allow mass assignment for 'name' field
     protected $casts = [
         'created_at' => 'datetime',
         'updated_at' => 'datetime',
     ]; // Cast timestamps to datetime objects
    
    public function reminders()
    {
        return $this->morphedByMany(Reminder::class, 'taggable')->withTimestamps();
    }
    
    public function diaryEntries()
    {
        return $this->morphedByMany(DiaryEntry::class, 'taggable')->withTimestamps();
    }
 }