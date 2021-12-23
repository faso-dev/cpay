<?php

namespace CC\Sdk;

interface PayementInterface
{
    public function submit(callable $onSuccess, callable $onError);
}