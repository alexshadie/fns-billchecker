<?php


namespace alexshadie\fns;


class SessionData
{
    private string $clientSecret;
    private string $sessionId;
    private string $refreshToken;

    public static function generateClientSecret(): string
    {
        return "mnALjKobrqT/sC9um4wXlamXnOo=";
    }

    /**
     * SessionData constructor.
     * @param string $clientSecret
     * @param string $sessionId
     * @param string $refreshToken
     */
    public function __construct(string $clientSecret, string $sessionId, string $refreshToken)
    {
        $this->clientSecret = $clientSecret;
        $this->sessionId = $sessionId;
        $this->refreshToken = $refreshToken;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
}