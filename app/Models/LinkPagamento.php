<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkPagamento extends Model
{
    protected $table = 'links_pagamentos';
    protected $fillable = [
        'nu_link', 
        'url_link', 
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
        'tp_mostrar_itens_checkout', 
        'vendas'
    ];

    public function itens()
    {
        return $this->hasMany(Item::class, 'link_pagamento_id');
    }

    public function responseData()
    {
        return $this->belongsTo(ResponseData::class, 'link_pagamento_id');
    }

    public static $rules = [
        'nu_link' => 'required|integer',
        'url_link' => 'required|url',
        'slug' => 'required|string',
        'dt_validade' => 'nullable|date',
        'nu_max_pagamentos' => 'nullable|integer',
        'tp_quantidade' => 'required|boolean',
        'ds_softdescriptor' => 'required|string',
        'tp_boleto' => 'required|boolean',
        'tp_pagamento_boleto' => 'required|string',
        'nu_max_parcelas_boleto' => 'nullable|integer',
        'dia_cobranca_boleto' => 'nullable|integer',
        'nu_baixa_automatica_boleto' => 'nullable|integer',
        'nu_boleto_dias_vencimento' => 'nullable|integer',
        'tp_credito' => 'required|boolean',
        'tp_pagamento_credito' => 'required|string',
        'nu_max_parcelas_credito' => 'nullable|integer',
        'dia_cobranca_credito' => 'nullable|integer',
        'vl_total' => 'required|numeric',
        'tp_mostrar_itens_checkout' => 'required|boolean',
        'vendas' => 'required|integer',
    ];
}
