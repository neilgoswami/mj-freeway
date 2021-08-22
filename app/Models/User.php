<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    public function consumptions()
    {
        return $this->hasMany(Consumption::class);
    }

    public function getConsumptions(User $user)
    {
        $consumptions = $user->consumptions()->whereDate('created_at', '=', Carbon::today())->with('drink')->get();

        $totalCaffeineConsumed = 0;
        $safeLevelCaffeine = Config::get('constants.caffeine_safe_level');
        $minConsumableCaffeineLevel = $safeLevelCaffeine;

        if ($consumptions) {
            foreach ($consumptions as $key => $consumption) {
                $caffeineLevel = $consumption['drink']['caffeine'];

                $totalCaffeineConsumed += $caffeineLevel;

                $minConsumableCaffeineLevel = $caffeineLevel < $minConsumableCaffeineLevel ? $caffeineLevel : $minConsumableCaffeineLevel;
            }
        }

        $caffeineLeftToReachSafeLevel = $safeLevelCaffeine - $totalCaffeineConsumed;

        return [
            'safe_level' => $safeLevelCaffeine,
            'consumed' => $totalCaffeineConsumed,
            'consumable' => $caffeineLeftToReachSafeLevel,
            'consumptions' => $consumptions,
        ];
    }
}
