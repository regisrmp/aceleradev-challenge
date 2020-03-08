<?php
// carrega o autoloader das classes
include_once("bootstrap.php");

// necessário preencher o TOKEN na classe de configuracao config/Config.class.php
$meu_token = !empty(Config::$meu_token) ? Config::$meu_token : die("Token não informado no arquivo de configuração.");
echo "<h4>O meu token é:</h4>";
echo "$meu_token<br>";

// ler o desafio e salvar no arquivo answer.json
file_put_contents("answer.json", Helpers::lerDesafio());

// carrega o json recebido dentro da variavel
$json = json_decode(file_get_contents("answer.json"));

// joga os dados do json nas variaveis
$mensagem_criptografada = $json->cifrado;
$numero_casas = $json->numero_casas;

// instancia a classe
$dc = new DesafioCriptografia();

// executa a descriptografia
$mensagem_descriptografada = $dc->descriptografa($mensagem_criptografada, $numero_casas);

// gera o hash SHA1
$sha1 = Helpers::getSHA1($mensagem_descriptografada);

// exibe os detalhes
echo "<h4>Dados da mensagem:</h4>";
echo "Mensagem criptografada: \"$mensagem_criptografada\"<br>";
echo "Mensagem descriptografada: \"$mensagem_descriptografada\"<br>";
echo "SHA1: $sha1<br>";

// retorna para a variavel json os valores transformados
$json->decifrado = $mensagem_descriptografada;
$json->resumo_criptografico = $sha1;

// salva novamente o json
file_put_contents("answer.json", json_encode($json));

echo "<h4>Arquivo salvo, veja os detalhes abaixo:</h4>";
var_dump(json_decode(file_get_contents("answer.json")));

// enviar o arquivo
echo "<h4>Enviando o arquivo answer.json:</h4>";
$response = Helpers::enviarArquivo("answer.json");
var_dump($response);
