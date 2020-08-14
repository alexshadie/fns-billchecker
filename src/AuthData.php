<?php


namespace alexshadie\fns;


class AuthData
{
    private string $inn;
    private string $password;

    /**
     * AuthData constructor.
     * @param string $inn
     * @param string $password
     */
    public function __construct(string $inn, string $password)
    {
        $this->inn = $inn;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
