<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Domain\Questions\Models\QuestionAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Domain\Users\Models\UserAnswer
 *
 * @property int                             $id
 * @property int                             $patient_id
 * @property int                             $question_answer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read QuestionAnswer|null $answer
 * @property-read \Domain\Users\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer whereQuestionAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswer whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class UserAnswer extends Model
{
    protected $fillable = [
        'patient_id',
        'question_answer_id'
    ];

    /**
     * @return BelongsTo<User, self>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * @return HasOne<QuestionAnswer>
     */
    public function answer(): HasOne
    {
        return $this->hasOne(QuestionAnswer::class, 'question_answer_id');
    }
}
