<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
    'category_id',
    'teacher_id',
    'title',
    'slug',
    'description',
    'thumbnail',
    'price',
    'discount_price',
    'instructor_name',
    'level',
    'duration_hours',
    'is_featured',
    'is_active',
    ];

    public function teacher()
  {
    return $this->belongsTo(Teacher::class);
  }

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments')->withTimestamps();
    }

    public function isEnrolledBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return $this->enrollments()->where('user_id', $user->id)->exists();
    }

    public function displayPrice()
    {
        return $this->discount_price ?? $this->price;
    }
}
