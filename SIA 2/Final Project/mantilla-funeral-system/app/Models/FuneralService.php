<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuneralService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'inclusions',
        'availability_status',
        'image',
        'created_by',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isAvailable(): bool
    {
        return $this->availability_status === 'available';
    }
}
