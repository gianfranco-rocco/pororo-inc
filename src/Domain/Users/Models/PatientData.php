<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * \Domain\Users\Models\PatientData
 *
 * @property int                        $id
 * @property string                     $conditions
 * @property string                     $weight
 * @property string                     $height
 * @property \Illuminate\Support\Carbon $birth_date
 * @property \Domain\Users\Models\User  $patient
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData whereConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData wherePatient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData whereWeight($value)
 *
 * @property int $patient_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PatientData wherePatientId($value)
 *
 * @mixin \Eloquent
 */
class PatientData extends Model
{
    protected $fillable = [
        'conditions',
        'weight',
        'height',
        'birth_date',
        'patient_id'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    /**
     * @return BelongsTo<User, self>
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }
}
