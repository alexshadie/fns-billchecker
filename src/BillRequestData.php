<?php


namespace alexshadie\fns;


class BillRequestData
{
    private ?string $date;
    private ?int $sum;
    private ?string $fiscalNumber;
    private ?string $fiscalDocument;
    private ?string $fiscalSign;
    private ?string $operation;

    /**
     * BillRequestData constructor.
     * @param string|null $date
     * @param int|null $sum Set in kopecks
     * @param string|null $fiscalNumber
     * @param string|null $fiscalDocument
     * @param string|null $fiscalSign
     * @param string|null $operation
     */
    public function __construct(?string $date, ?int $sum, ?string $fiscalNumber, ?string $fiscalDocument, ?string $fiscalSign, ?string $operation)
    {
        $this->date = $date;
        $this->sum = $sum;
        $this->fiscalNumber = $fiscalNumber;
        $this->fiscalDocument = $fiscalDocument;
        $this->fiscalSign = $fiscalSign;
        $this->operation = $operation;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @return int|null
     */
    public function getSum(): ?int
    {
        return $this->sum;
    }

    /**
     * @return string|null
     */
    public function getFiscalNumber(): ?string
    {
        return $this->fiscalNumber;
    }

    /**
     * @return string|null
     */
    public function getFiscalDocument(): ?string
    {
        return $this->fiscalDocument;
    }

    /**
     * @return string|null
     */
    public function getFiscalSign(): ?string
    {
        return $this->fiscalSign;
    }

    /**
     * @return string|null
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }
}
