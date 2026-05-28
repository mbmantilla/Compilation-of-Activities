<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'reservation_code',
        'user_id',
        'funeral_service_id',
        'deceased_name',
        'deceased_age',
        'date_of_death',
        'preferred_schedule',
        'contact_person',
        'contact_number',
        'notes',
        'status',
        'admin_remarks',
        'approved_by',
        'cancelled_at',
    ];

    /**
     * Attribute type casting
     */
    protected $casts = [
        'date_of_death' => 'date',
        'preferred_schedule' => 'date',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Client relationship
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Funeral service relationship
     */
    public function service()
    {
        return $this->belongsTo(FuneralService::class, 'funeral_service_id');
    }

    /**
     * Approver relationship (admin who approved)
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Determine if a reservation can be cancelled by the client.
     *
     * Only reservations with 'pending' status can be cancelled by the client.
     */
    public function canBeCancelled(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Optional helper to check if reservation is upcoming
     */
    public function isUpcoming(): bool
    {
        return $this->status === 'approved' && $this->preferred_schedule && $this->preferred_schedule->isFuture();
    }

    /**
     * Optional helper to check if reservation was approved last month
     */
    public function wasApprovedLastMonth(): bool
    {
        $lastMonth = Carbon::now()->subMonth();
        return $this->status === 'approved'
            && $this->created_at->year === $lastMonth->year
            && $this->created_at->month === $lastMonth->month;
    }

    /**
     * Optional helper to check if reservation was cancelled last month
     */
    public function wasCancelledLastMonth(): bool
    {
        $lastMonth = Carbon::now()->subMonth();
        return $this->status === 'cancelled'
            && $this->cancelled_at
            && $this->cancelled_at->year === $lastMonth->year
            && $this->cancelled_at->month === $lastMonth->month;
    }
}