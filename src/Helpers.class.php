<?php

class Helpers
{

    static public function getSHA1($string)
    {
        return sha1($string);
    }


    static public function lerDesafio()
    {
        $url_consulta = "https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=" . Config::$meu_token;

        $request = curl_init($url_consulta);

        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_VERBOSE, 1);

        $response = curl_exec($request);

        return $response;
    }

    static public function enviarArquivo($filename)
    {
        $filetype = mime_content_type($filename);

        $url_envio = "https://api.codenation.dev/v1/challenge/dev-ps/submit-solution?token=" . Config::$meu_token;

        $request = curl_init($url_envio);

        $post = array(
            'answer' => new CurlFile(realpath($filename), $filetype, $filename),
        );

        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_POSTFIELDS, $post);
        curl_setopt($request, CURLOPT_VERBOSE, 1);

        $response = curl_exec($request);

        return $response;
    }
}
