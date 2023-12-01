<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Domain\Users\Models\PatientConversationTakeaway
 *
 * @property-read \Domain\Users\Models\User $patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConversationTakeaway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConversationTakeaway newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConversationTakeaway query()
 *
 * @property int                             $id
 * @property string                          $takeaways
 * @property int                             $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConversationTakeaway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConversationTakeaway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConversationTakeaway wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConversationTakeaway whereTakeaways($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConversationTakeaway whereUpdatedAt($value)
 *
 * @property string $takeaway
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConversationTakeaway whereTakeaway($value)
 *
 * @mixin \Eloquent
 */
class PatientConversationTakeaway extends Model
{
    protected $fillable = [
        'takeaway',
        'patient_id'
    ];

    /**
     * @return BelongsTo<User, self>
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
