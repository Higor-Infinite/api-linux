<?php

namespace App\Models;

use App\Enums\Prioridade;
use App\States\Ticket\TicketState;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\ModelStates\HasStates;

/**
 * @property int $id
 * @property string $titulo
 * @property string $descricao
 * @property TicketState $status
 * @property Prioridade $prioridade
 * @property int $responsavel_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $responsavel
 */
#[Fillable(['titulo', 'descricao', 'prioridade', 'responsavel_id'])]
class Ticket extends Model
{
    use HasStates;

        /**
     * Declarado como propriedade (e não no método casts()) para que o cast de
     * status já exista quando o HasStates definir o estado padrão.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => TicketState::class,
        'prioridade' => Prioridade::class,
    ];

    /**
     * Usuário responsável pelo ticket.
     *
     * @return BelongsTo<User, $this>
     */
    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }
}