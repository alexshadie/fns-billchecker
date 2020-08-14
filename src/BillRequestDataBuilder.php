<?php


namespace alexshadie\fns;

class BillRequestDataBuilder
{
    private ?string $date;
    private ?int $sum;
    private ?string $fiscalNumber;
    private ?string $fiscalDocument;
    private ?string $fiscalSign;
    private ?string $operation;

    public function create(): BillRequestData
    {
        return new BillRequestData(
            $this->date,
            $this->sum,
            $this->fiscalNumber,
            $this->fiscalDocument,
            $this->fiscalSign,
            $this->operation,
        );
    }

    public static function fromRequestData(BillRequestData $requestData): BillRequestDataBuilder
    {
        $builder = new BillRequestDataBuilder();
        $builder->date = $requestData->getDate();
        $builder->sum = $requestData->getSum();
        $builder->fiscalNumber = $requestData->getFiscalNumber();
        $builder->fiscalDocument = $requestData->getFiscalDocument();
        $builder->fiscalSign = $requestData->getFiscalSign();
        $builder->operation = $requestData->getOperation();
        return $builder;
    }

    public static function fromQr(string $qrCode): BillRequestDataBuilder
    {
        parse_str($qrCode, $qrCodeParams);
        $builder = new BillRequestDataBuilder();
        $builder->date = $qrCodeParams['t'] ?? null;
        $builder->sum = $qrCodeParams['s'] ? 100 * $qrCodeParams['s'] : null;
        $builder->fiscalNumber = $qrCodeParams['fn'] ?? null;
        $builder->fiscalDocument = $qrCodeParams['i'] ?? null;
        $builder->fiscalSign = $qrCodeParams['fp'] ?? null;
        $builder->operation = $qrCodeParams['n'] ?? null;
        return $builder;
    }

    /**
     * @param string|null $date
     * @return BillRequestDataBuilder
     */
    public function setDate(?string $date): BillRequestDataBuilder
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Sum is set in kopecks
     * @param int|null $sum
     * @return BillRequestDataBuilder
     */
    public function setSum(?int $sum): BillRequestDataBuilder
    {
        $this->sum = $sum;
        return $this;
    }

    /**
     * @param string|null $fiscalNumber
     * @return BillRequestDataBuilder
     */
    public function setFiscalNumber(?string $fiscalNumber): BillRequestDataBuilder
    {
        $this->fiscalNumber = $fiscalNumber;
        return $this;
    }

    /**
     * @param string|null $fiscalDocument
     * @return BillRequestDataBuilder
     */
    public function setFiscalDocument(?string $fiscalDocument): BillRequestDataBuilder
    {
        $this->fiscalDocument = $fiscalDocument;
        return $this;
    }

    /**
     * @param string|null $fiscalSign
     * @return BillRequestDataBuilder
     */
    public function setFiscalSign(?string $fiscalSign): BillRequestDataBuilder
    {
        $this->fiscalSign = $fiscalSign;
        return $this;
    }

    /**
     * @param string|null $operation
     * @return BillRequestDataBuilder
     */
    public function setOperation(?string $operation): BillRequestDataBuilder
    {
        $this->operation = $operation;
        return $this;
    }
}
