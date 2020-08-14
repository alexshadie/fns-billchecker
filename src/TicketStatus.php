<?php


namespace alexshadie\fns;


class TicketStatus
{
    private string $kind;
    private string $id;
    private int $status;

    /**
     * TicketStatus constructor.
     * @param string $kind
     * @param string $id
     * @param int $status
     */
    public function __construct(string $kind, string $id, int $status)
    {
        $this->kind = $kind;
        $this->id = $id;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}