<?php
class ComunicacaoAPI
{
    public function enviaConteudoParaAPI($cabecalho = array(), $conteudoAEnviar, $url, $tpRequisicao)
    {
        try {
            $ch = curl_init($url);
            // Marca que vai enviar por POST(1=SIM), caso tpRequisicao seja igual a "POST"
            if ($tpRequisicao == 'POST') {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $conteudoAEnviar);
            }

            if (!empty($cabecalho)) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecalho);
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            /*
            Caso você não receba retorno da API, pode estar com problema de SSL.
            Remova o comentário da linha abaixo para desabilitar a verificação.
            */
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $resposta = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $resposta;
    }
}
