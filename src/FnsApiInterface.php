<?php

namespace alexshadie\fns;

interface FnsApiInterface
{
    public function authenticate(AuthData $authData): SessionData;

    public function refresh(SessionData $sessionData): SessionData;

    public function setSessionData(SessionData $sessionData);

    public function checkVersion(): Version;

    public function checkTicket($qrData): TicketStatus;

    public function getTicket($ticketId): Ticket;
}
