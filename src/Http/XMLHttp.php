<?php

namespace CC\Http;

use CC\Response\XMLResponse;
use function curl_close;
use function curl_errno;
use function curl_error;
use function curl_exec;
use function curl_init;
use function curl_setopt;
use const CURLOPT_HTTPHEADER;
use const CURLOPT_POST;
use const CURLOPT_POSTFIELDS;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_SSL_VERIFYPEER;
use const CURLOPT_URL;

class XMLHttp
{
    public const WITH_SSL_ENABLED = true;
    public const WITH_SSL_DISABLED = false;

    public static function request(string $url, array $headers, mixed $body, bool $withSSLEnabled = self::WITH_SSL_ENABLED): array
    {
        $request = curl_init();
        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_POST, true);
        curl_setopt($request, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_POSTFIELDS, $body);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, $withSSLEnabled);
        $response = curl_exec($request);
        $errno = curl_errno($request);
        $error = curl_error($request);
        curl_close($request);
        return [
            $errno,
            $error,
            XMLResponse::parse("<response>$response</response>")
        ];
    }

}