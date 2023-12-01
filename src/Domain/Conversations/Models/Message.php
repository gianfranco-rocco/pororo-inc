<?php

declare(strict_types=1);

namespace Domain\Conversations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Domain\Conversations\Models\Message
 *
 * @property int                        $id
 * @property int                        $conversation_id
 * @property string                     $role
 * @property string                     $content
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereConversationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 *
 * @property-read \Domain\Conversations\Models\Conversation $conversation
 *
 * @mixin \Eloquent
 */
class Message extends Model
{
    protected $guarded = ['id'];

    /**
     * @return BelongsTo<Conversation, Message>
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function content(): string
    {
        $jsonContent = json_decode($this->content, true);

        if (gettype($jsonContent) === 'array') {
            return array_key_exists('content', $jsonContent) ? $jsonContent['content'] : '';
        }

        return $this->content;
    }

    public function isFromAssistant(): bool
    {
        return $this->role === 'assistant';
    }
}
