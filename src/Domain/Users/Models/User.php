<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Domain\Users\Enums\Role;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Domain\Users\Models\User
 *
 * @property int                        $id
 * @property string                     $name
 * @property string                     $last_name
 * @property string                     $phone_number
 * @property Role                       $role
 * @property string                     $email
 * @property string|null                $remember_token
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;

    protected $fillable = [
        'name',
        'last_name',
        'phone_number',
        'email',
        'role'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'role' => Role::class,
    ];

    /**
     * @return HasOne<PatientData>
     */
    public function patientData(): HasOne
    {
        return $this->hasOne(PatientData::class, 'patient_id', 'id');
    }

    public function isPatient(): bool
    {
        return $this->role === Role::PATIENT;
    }
}
