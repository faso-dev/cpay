<?php

namespace CC\Sdk\Config;

use JetBrains\PhpStorm\Pure;

class Credentials
{
    private function __construct(private string $username, private string $password, private string $merchant)
    {

    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Credentials
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Credentials
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchant(): string
    {
        return $this->merchant;
    }

    /**
     * @param string $merchant
     * @return Credentials
     */
    public function setMerchant(string $merchant): self
    {
        $this->merchant = $merchant;
        return $this;
    }


    public static function from(string $username, string $password, string $merchant): self
    {
        return new self(username: $username, password: $password, merchant: $merchant);
    }
}