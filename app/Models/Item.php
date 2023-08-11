<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'itens_pagamentos';
    protected $fillable = [
        'link_pagamento_id',
        'request_data_id',
        'nm_item',
        'ds_item',
        'vl_item',
        'qtd_item',
        'cd_item_venda',      
        'tp_situacao',        
        'id_cliente_vendedor',
        'id_usuario_vendedor',
        'nu_parcela',         
        'tp_legado',          
        'tp_produto_servico', 
        'id_nbs_ncm',         
        'categoria',          
        'id_cnae',            
        'id_cst',             
        'tx_iss',             
        'tp_principal',       
        'pivot',              // Tratado como un campo JSON
    ];

    public function linkPagamento()
    {
        return $this->belongsTo(LinkPagamento::class, 'link_pagamento_id');
    }

    public function requestData()
    {
        return $this->belongsTo(RequestData::class, 'request_data_id');
    }

    public static $rules = [
        'nm_item' => 'nullable|string|max:255',
        'ds_item' => 'nullable|string|max:255',
        'vl_item' => 'nullable|numeric',
        'qtd_item' => 'nullable|integer|min:1',
        'cd_item_venda' => 'nullable|string|max:255',
        'tp_situacao' => 'nullable|string|max:255',
        'id_cliente_vendedor' => 'nullable|integer',
        'id_usuario_vendedor' => 'nullable|integer',
        'nu_parcela' => 'nullable|integer',
        'tp_legado' => 'nullable|string|max:255',
        'tp_produto_servico' => 'nullable|string|max:255',
        'id_nbs_ncm' => 'nullable|integer',
        'categoria' => 'nullable|string|max:255',
        'id_cnae' => 'nullable|integer',
        'id_cst' => 'nullable|integer',
        'tx_iss' => 'nullable|string|max:255',
        'tp_principal' => 'nullable|string|max:255',
        'pivot' => 'nullable|json',  // Campo JSON
    ];
}