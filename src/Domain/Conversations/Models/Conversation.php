<?php

declare(strict_types=1);

namespace Domain\Conversations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Domain\Conversations\Models\Conversation
 *
 * @property int                             $id
 * @property string                          $ip
 * @property string                          $thread_id
 * @property \Illuminate\Support\Carbon      $created_at
 * @property \Illuminate\Support\Carbon      $updated_at
 * @property \Illuminate\Support\Carbon|null $closed_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereVerdictType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereUpdatedAt($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Domain\Conversations\Models\Message> $messages
 * @property-read int|null $messages_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereThreadId($value)
 *
 * @property int $patient_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereClosedAt($value)
 *
 * @mixin \Eloquent
 */
class Conversation extends Model
{
    protected $guarded = ['id'];

    /**
     * @return HasMany<Message>
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function isClosed(): bool
    {
        return ! is_null($this->closed_at);
    }
}
