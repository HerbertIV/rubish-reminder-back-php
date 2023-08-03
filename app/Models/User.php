<?php

namespace App\Models;

use App\Models\Contracts\ReceiverContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements ReceiverContract
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'active',
        'email_from_process',
        'phone_from_process',
        'process_email_expire_at',
        'process_phone_expire_at',
        'process_token',
        'sms_code',
        'region_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'process_email_expire_at' => 'datetime',
        'process_phone_expire_at' => 'datetime',
        'active' => 'bool',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('first_name', 'like', '%'.$query.'%')
                ->orWhere('last_name', 'like', '%'.$query.'%')
                ->orWhere('concat(first_name, \' \', last_name)', 'like', '%'.$query.'%')
                ->orWhere('concat(last_name, \' \', first_name)', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%');
    }
}
