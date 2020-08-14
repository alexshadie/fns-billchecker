<?php

namespace alexshadie\fns;

use alexshadie\fns\exception\FnsCallException;

class FnsApi implements FnsApiInterface
{
    private ?SessionData $sessionData;

    /**
     * FnsApi constructor.
     * @param SessionData|null $sessionData
     */
    public function __construct(?SessionData $sessionData = null)
    {
        $this->sessionData = $sessionData;
    }

    private function query($method, $path, $data = [])
    {
        $ch = curl_init();

//        curl_setopt($ch, CURLOPT_VERBOSE, true);

        curl_setopt($ch, CURLOPT_URL, 'https://irkkt-mobile.nalog.ru:8888/' . $path);

        $headers = [
            'ClientVersion: 2.9.0',
            'Device-Id: noFirebaseToken',
            'Device-OS: Android',
            'Host: irkkt-mobile.nalog.ru:8888',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip',
            'User-Agent: okhttp/4.2.2',
        ];

        if ($this->sessionData) {
            $headers[] = 'sessionId: ' . $this->sessionData->getSessionId();
        }

        if ($method == 'POST') {
            $data = json_encode($data);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $headers[] = 'Content-Type: application/json; charset=UTF-8';
            $headers[] = 'Content-Length: ' . strlen($data);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $body = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

        // TODO: Check session
        if ($responseCode == 401) {
            throw new FnsCallException('Unauthorized');
        }

        return [substr($body, $headerSize), $responseCode, substr($body, 0, $headerSize)];
    }

    public function authenticate(AuthData $authData): SessionData
    {
        $clientSecret = SessionData::generateClientSecret();

        list($body, $code, $headers) = $this->query('POST', 'v2/mobile/users/lkfl/auth', [
            'client_secret' => $clientSecret,
            'inn' => $authData->getInn(),
            'password' => $authData->getPassword(),
        ]);

        if ($code != 200) {
            throw new FnsCallException("Invalid response code");
        }

        $result = json_decode($body, 1);

        return new SessionData($clientSecret, $result['sessionId'], $result['refresh_token']);
    }

    public function refresh(SessionData $sessionData): SessionData
    {
        $this->sessionData = null;

        list($body, $code, $headers) = $this->query('POST', 'v2/mobile/users/refresh', [
            'client_secret' => $sessionData->getClientSecret(),
            'refresh_token' => $sessionData->getRefreshToken(),
        ]);

        if ($code != 200) {
            throw new FnsCallException("Invalid response code");
        }

        $result = json_decode($body, 1);

        return new SessionData($sessionData->getClientSecret(), $result['sessionId'], $result['refresh_token']);
    }

    public function setSessionData(SessionData $sessionData)
    {
        $this->sessionData = $sessionData;
    }

    public function checkVersion(): Version
    {
        list($body, $code, $headers) = $this->query('GET', 'v1/version');

        if ($code != 200) {
            throw new FnsCallException("Invalid response code");
        }

        $result = json_decode($body, 1);
        if (!isset($result['version'])) {
            throw new FnsCallException("Invalid result: " . $body);
        }

        return new Version($result['version']['version'], $result['version']['revision']);
    }

    public function checkTicket($qrData): TicketStatus
    {
        list($body, $code, $headers) = $this->query('POST', 'v2/ticket', ['qr' => $qrData,]);

        if ($code != 200) {
            throw new FnsCallException("Invalid response code");
        }

        $data = json_decode($body, 1);

        return new TicketStatus($data['kind'], $data['id'], $data['status']);
    }

    public function getTicket($ticketId): Ticket
    {
        list($body, $code, $headers) = $this->query('GET', 'v2/tickets/' . $ticketId);

        if ($code != 200) {
            throw new FnsCallException("Invalid response code");
        }

        $data = json_decode($body, 1);

        $ticket = new Ticket(
            $data['id'],
            $data['status'],
            $data['kind'],
            $data['createdAt'],
            $data['statusDescription'],
            $data['qr'],
            $data['operation']['date'],
            $data['seller']['name'],
            $data['seller']['inn'],
            $data['ticket']['document']['receipt']['items']
        );

        return $ticket;
    }
}
