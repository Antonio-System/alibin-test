<?php

namespace App\Http\Controllers;


use App\Models\RequestData;
use App\Services\LinkPagamentoService;
use Illuminate\Http\Request;


class LinkPagamentoController extends Controller
{
    protected $linkPagamentoService;

    public function __construct(LinkPagamentoService $linkPagamentoService)
    {
        $this->linkPagamentoService = $linkPagamentoService;
    }

    public function getLinks(Request $request)
    {
        try {
            $nuLink = $request->input('nuLink', null);
            $page = $request->input('page', null);
            $perPage = $request->input('perPage', null);

            $data = $this->linkPagamentoService->getLinks($nuLink, $page, $perPage);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'line'  => $e->getLine(),
                'file' => $e->getFile(),
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function excluirLinks($linkId)
    {
        try {
            $responseData = $this->linkPagamentoService->excluirLink($linkId);

            return response()->json([
                'success' => true,
                'data' => $responseData
            ]);

        } catch (\Illuminate\Http\Client\RequestException $e) {
           
            if ($e->response && $e->response->status() === 404) {
                return response()->json(['error' => 'link not found'], 404);
            } else {
                return response()->json(['error' => 'Error processing the request'], 500);
            }
       
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createLink(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'slug' => 'required|string|max:255',
                'dt_validade' => 'nullable|date',
                'nu_max_pagamentos' => 'nullable|integer',
                'tp_quantidade' => 'nullable|boolean',
                'ds_softdescriptor' => 'required|string|max:255',
                'tp_boleto' => 'required|boolean',
                'tp_pagamento_boleto' => 'required_if:tp_boleto,true|string|max:2',
                'nu_max_parcelas_boleto' => 'nullable|integer',
                'dia_cobranca_boleto' => 'nullable|integer',
                'nu_baixa_automatica_boleto' => 'nullable|integer',
                'nu_boleto_dias_vencimento' => 'nullable|integer',
                'tp_credito' => 'required|boolean',
                'tp_pagamento_credito' => 'required_if:tp_credito,true|string|max:2',
                'nu_max_parcelas_credito' => 'nullable|integer',
                'dia_cobranca_credito' => 'nullable|integer',
                'vl_total' => 'required|numeric',
                'tp_mostrar_itens_checkout' => 'required|boolean',
                'itens.*.nm_item' => 'required|string|max:255',
                'itens.*.ds_item' => 'required|string|max:255',
                'itens.*.qtd_item' => 'required|integer|min:1',
                'itens.*.vl_item' => 'required|numeric|min:0',
            ]);
    
            return $this->linkPagamentoService->createLink($validatedData);
            
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}