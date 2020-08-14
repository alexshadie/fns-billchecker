<?php


namespace alexshadie\fns;


class Ticket
{
    private string $id;
    private int $status;
    private string $kind;
    private string $createdAt;
    private array $statusDescription;
    private string $qr;
    private string $date;
    private string $sellerName;
    private string $sellerInn;
    private array $items;

    /**
     * Ticket constructor.
     * @param string $id
     * @param int $status
     * @param string $kind
     * @param string $createdAt
     * @param array $statusDescription
     * @param string $qr
     * @param string $date
     * @param string $sellerName
     * @param string $sellerInn
     * @param array $items
     */
    public function __construct(string $id, int $status, string $kind, string $createdAt, array $statusDescription, string $qr, string $date, string $sellerName, string $sellerInn, array $items)
    {
        $this->id = $id;
        $this->status = $status;
        $this->kind = $kind;
        $this->createdAt = $createdAt;
        $this->statusDescription = $statusDescription;
        $this->qr = $qr;
        $this->date = $date;
        $this->sellerName = $sellerName;
        $this->sellerInn = $sellerInn;
        $this->items = $items;
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
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return array
     */
    public function getStatusDescription(): array
    {
        return $this->statusDescription;
    }

    /**
     * @return string
     */
    public function getQr(): string
    {
        return $this->qr;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getSellerName(): string
    {
        return $this->sellerName;
    }

    /**
     * @return string
     */
    public function getSellerInn(): string
    {
        return $this->sellerInn;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}