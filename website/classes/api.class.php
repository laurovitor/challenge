<?php
class API
{
    public function enviaConteudoParaAPI($cabecalho = array(), $conteudoAEnviar, $url, $tpRequisicao)
    {
        try {
            $ch = curl_init('http://' . $_ENV['API_URL'] . ':' . $_ENV['API_PORT']  . $url);
            switch ($tpRequisicao) {
                case 'POST':
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $conteudoAEnviar);
                    break;
                case 'PATCH':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $conteudoAEnviar);
                    break;
                case 'DELETE':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    break;
                default:
                    // GET é definido como padrão.
                    break;
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
