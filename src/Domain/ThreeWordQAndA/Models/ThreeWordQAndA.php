<?php

namespace Domain\ThreeWordQAndA\Models;

use Domain\Users\Models\User;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

/**
 * Domain\ThreeWordQAndA\Models\ThreeWordQAndA
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ThreeWordQAndA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThreeWordQAndA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThreeWordQAndA query()
 * @property-read User|null $patient
 * @mixin \Eloquent
 */
class ThreeWordQAndA extends Model
{
    protected $guarded = ['id'];

    protected $table = 'three_word_q_and_a';

    /**
     * Get the user that owns the ThreeWordGameQAndA instance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
