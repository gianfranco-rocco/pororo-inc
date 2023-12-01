<?php

declare(strict_types=1);

namespace Domain\Questions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Domain\Questions\Models\QuestionAnswer
 *
 * @property int                        $id
 * @property int                        $question_id
 * @property string                     $answer
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Domain\Questions\Models\Question $question
 *
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereUpdatedAt($value)
 *
 * @property int $id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereAnswer($value)
 *
 * @mixin \Eloquent
 */
class QuestionAnswer extends Model
{
    protected $fillable = [
        'question_id',
        'answer',
    ];

    /**
     * @return BelongsTo<Question, self>
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
