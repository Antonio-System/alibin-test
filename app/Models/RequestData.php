<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class RequestData extends Model
{
    protected $fillable = [
        'slug',
        'dt_validade',
        'nu_max_pagamentos',
        'tp_quantidade',
        'ds_softdescriptor',
        'tp_boleto',
        'tp_pagamento_boleto',
        'nu_max_parcelas_boleto',
        'dia_cobranca_boleto',
        'nu_baixa_automatica_boleto',
        'nu_boleto_dias_vencimento',
        'tp_credito',
        'tp_pagamento_credito',
        'nu_max_parcelas_credito',
        'dia_cobranca_credito',
        'vl_total',
        'tp_mostrar_itens_checkout'
    ];

    protected $casts = [
        'tp_quantidade' => 'boolean',
        'tp_boleto' => 'boolean',
        'tp_credito' => 'boolean',
        'itens' => 'array'
    ];

    public function response()
    {
        return $this->hasOne(ResponseData::class);
    }

    public function itens()
    {
        return $this->hasMany(Item::class, 'request_data_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $now = Carbon::now();
            $model->created_at = $now;
        });
    }
}
