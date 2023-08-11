<?php

namespace App\Services;

use App\Models\RequestData;
use App\Models\ResponseData;
use App\Models\LinkPagamento;
use App\Models\Item;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class LinkPagamentoService
{
    private $header;

    public function __construct()
    {
        $this->header = [
            'Content-Type' => 'application/json',
            'Client-Code' => env('CLIENT_CODE'),
            'Client-Key' => env('CLIENT_KEY'),
        ];
    }

    public function getLinks($nuLink, $page, $perPage)
    {
        $queryParams = [];

        if ($nuLink !== null) {
            $queryParams['nu_link'] = $nuLink;
        }

        if ($page !== null) {
            $queryParams['page'] = $page;
        }

        if ($perPage !== null) {
            $queryParams['per_page'] = $perPage;
        }

        $response = Http::withHeaders($this->header)
            ->get("https://api-sandbox.fpay.me/link", $queryParams);

        $data = $response->json();

        return $data;
    }

    public function excluirLink($linkId)
    {
        {
            $response = Http::withHeaders($this->header)
                ->delete("https://api-sandbox.fpay.me/link/{$linkId}");
    
            if ($response->status() === 404) {
                throw new \Illuminate\Http\Client\RequestException($response);
            }
    
            $responseData = $response->json();
    
            if (isset($responseData['success']) && $responseData['success'] === false) {
                if (isset($responseData['errors']) && is_array($responseData['errors'])) {
                    $error = $responseData['errors'][0] ?? null;
                    if ($error && isset($error['message'])) {
                        throw new \Exception($error['message']);
                    }
                }
    
                throw new \Exception('Unknown error excluding link.');
            }
    
            return $responseData;
        }
    }

    public function createLink(array $requestData)
    {
        try {
            $requestRecord = RequestData::create($requestData);

            foreach ($requestData['itens'] as $itemData) {
                $requestRecord->itens()->create($itemData);
            }

            $response = Http::withHeaders($this->header)
                ->post("https://api-sandbox.fpay.me/link", $requestData);

            $responseData = $response->json();

            
            DB::beginTransaction();
            try {
                     
                            
                $responseRecord = new ResponseData([
                    'success' => $responseData['success'],
                    'error_code' => implode(', ', array_column($responseData['errors'], 'code')),
                    'error_message' =>implode(', ', array_column($responseData['errors'], 'message')),
                    'request_data_id' => $requestRecord->id,
                ]);

                if ($responseData['success']) {
                    $linkData = $responseData['data'];

                    $linkPagamento = LinkPagamento::create([
                        'nu_link' => $linkData['nu_link'],
                        'url_link' => $linkData['url_link'],
                        'slug' => $linkData['slug'],
                        'dt_validade' => $linkData['dt_validade'],
                        'nu_max_pagamentos' => $linkData['nu_max_pagamentos'] ?? null,
                        'tp_quantidade' => $linkData['tp_quantidade'] ?? null,
                        'ds_softdescriptor' => $linkData['ds_softdescriptor'] ?? null,
                        'tp_boleto' => $linkData['tp_boleto'] ?? null,
                        'tp_pagamento_boleto' => $linkData['tp_pagamento_boleto'] ?? null,
                        'nu_max_parcelas_boleto' => $linkData['nu_max_parcelas_boleto'] ?? null,
                        'dia_cobranca_boleto' => $linkData['dia_cobranca_boleto'] ?? null,
                        'nu_baixa_automatica_boleto' => $linkData['nu_baixa_automatica_boleto'] ?? null,
                        'nu_boleto_dias_vencimento' => $linkData['nu_boleto_dias_vencimento'] ?? null,
                        'tp_credito' => $linkData['tp_credito'] ?? null,
                        'tp_pagamento_credito' => $linkData['tp_pagamento_credito'] ?? null,
                        'nu_max_parcelas_credito' => $linkData['nu_max_parcelas_credito'] ?? null,
                        'dia_cobranca_credito' => $linkData['dia_cobranca_credito'] ?? null,
                        'vl_total'  => $linkData['vl_total'] ?? null,
                        'tp_mostrar_itens_checkout'  => $linkData['tp_mostrar_itens_checkout'] ?? null,
                        'vendas' => $linkData['vendas'] ?? null,
                    ]);

                    if (isset($linkData['itens']) && is_array($linkData['itens'])) {
                        foreach ($linkData['itens'] as $item) {
                            $itemData = [
                                'nm_item' => $item['nm_item'] ?? null,
                                'ds_item' => $item['ds_item'] ?? null,
                                'qtd_item' => $item['qtd_item'] ?? null,
                                'vl_item' => $item['vl_item'] ?? null,
                                'cd_item_venda' => $item['cd_item_venda'] ?? null,
                                'tp_situacao' => $item['tp_situacao'] ?? null,
                                'id_cliente_vendedor' => $item['id_cliente_vendedor'] ?? null,
                                'id_usuario_vendedor' => $item['id_usuario_vendedor'] ?? null,
                                'nu_parcela' => $item['nu_parcela'] ?? null,
                                'tp_legado' => $item['tp_legado'] ?? null,
                                'tp_produto_servico' => $item['tp_produto_servico'] ?? null,
                                'id_nbs_ncm' => $item['id_nbs_ncm'] ?? null,
                                'categoria' => $item['categoria'] ?? null,
                                'id_cnae' => $item['id_cnae'] ?? null,
                                'id_cst' => $item['id_cst'] ?? null,
                                'tx_iss' => $item['tx_iss'] ?? null,
                                'tp_principal' => $item['tp_principal'] ?? null,
                                'pivot' => json_encode($item['pivot'] ?? null),  // Campo pivot
                            ];
                            $itemModel = new Item($itemData);
                            $linkPagamento->itens()->save($itemModel);
                                                       
                        }
                    }

                    $responseRecord->link_pagamento_id = $linkPagamento->id;
                    $responseRecord->save();

                    DB::commit();             

                    return response()->json($responseData, 201);
                } else {
                    
                    $responseRecord->save();
                    DB::commit();
                    return response()->json($responseData, 422); //
                }
                
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'success'  => false,
                    'line'  => $e->getLine(),
                    'file' => $e->getFile(),
                    'error' => $e->getMessage()
                ], 422);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'line'  => $e->getLine(),
                'file' => $e->getFile(),
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
