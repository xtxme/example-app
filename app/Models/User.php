<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'birthdate',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    protected function casts(): array //เวลาอ่าน/เขียนฟิลด์บางตัว ควรแปลงชนิดข้อมูลยังไง”
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthdate' => 'date', // วันเดือนปีแบบ date-only
        ];
    }

    public function bio(): HasOne
    {
        return $this->hasOne(UserBio::class, 'user_id');
    }
    public function diaryEntries()
    {
        return $this->hasMany(DiaryEntry::class);
    }

    public function socialLinks()
    {
        return $this->hasMany(\App\Models\SocialLink::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
