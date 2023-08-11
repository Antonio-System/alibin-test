<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ResponseData extends Model
{
    protected $table = 'response_data';
    protected $fillable = [
        'success', 'error_code', 'error_message', 'request_data_id', 'link_pagamento_id'
    ];

    public function request()
    {
        return $this->belongsTo(RequestData::class, 'request_data_id');
    }

    public function linkPagamento()
    {
        return $this->hasOne(LinkPagamento::class, 'link_pagamento_id');
    }

    public static $rules = [
        'success' => 'required|boolean',
        'error_code' => 'nullable|string',
        'error_message' => 'nullable|string',
        'request_data_id' => 'required|integer',
        'link_pagamento_id' => 'required|integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $now = Carbon::now();
            $model->created_at = $now;
        });
    }
}
