<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Domain\Conversations\Models\Conversation;
use Domain\Questions\Models\QuestionAnswer;
use Domain\Users\Enums\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
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
 * @property string|null                $profile_picture_disk
 * @property string|null                $profile_picture_path
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
 * @property-read \Domain\Users\Models\PatientData|null $patientData
 * @property-read \Illuminate\Database\Eloquent\Collection<int, QuestionAnswer> $questionsAnswered
 * @property-read int|null $questions_answered_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePictureDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePicturePath($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, QuestionAnswer> $answers
 * @property-read int|null $answers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Conversation> $conversations
 * @property-read int|null $conversations_count
 * @property int|null $caregiver_id
 * @property-read User|null $caregiver
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCaregiverId($value)
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
        'role',
        'profile_picture_disk',
        'profile_picture_path',
        'caregiver_id'
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
        return $this->hasOne(PatientData::class, 'patient_id');
    }

    /**
     * @return HasMany<UserAnswer>
     */
    public function answers(): HasMany
    {
        return $this->hasMany(UserAnswer::class, 'patient_id');
    }

    /**
     * @return HasMany<Conversation>
     */
    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'patient_id');
    }

    /**
     * @return BelongsTo<User, self>
     */
    public function caregiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'caregiver_id');
    }

    /**
     * @return Collection<int, self>
     */
    public function careReceivers(): Collection
    {
        return User::query()
            ->where('caregiver_id', $this->id)
            ->get();
    }

    public function isPatient(): bool
    {
        return $this->role === Role::PATIENT;
    }

    public function profilePictureUrl(): ?string
    {
        $disk = $this->profile_picture_disk;
        $path = $this->profile_picture_path;

        if (! $disk || ! $path) {
            return null;
        }

        $storage = Storage::disk($disk);

        if ($disk === 'local') {
            return $storage->path($path);
        }

        return $storage->url($path);
    }
}
