<?php

declare(strict_types=1);

namespace Domain\ThreeWordQAndA\Models;

use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Domain\ThreeWordQAndA\Models\ThreeWordQAndA
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ThreeWordQAndA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThreeWordQAndA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThreeWordQAndA query()
 *
 * @property-read User|null $patient
 *
 * @mixin \Eloquent
 */
class ThreeWordQAndA extends Model
{
    protected $guarded = ['id'];

    protected $table = 'three_word_q_and_a';

    /**
     * Get the user that owns the ThreeWordGameQAndA instance
     * @return BelongsTo<User, self>
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
