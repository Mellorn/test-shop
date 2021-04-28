<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\PaymentService as ServiceContract;

final class PaymentService implements ServiceContract
{
    /**
     * Details of error.
     *
     * @var array|null
     */
    protected ?array $error = null;

    /**
     * Whether the payment has been processed.
     *
     * @var bool
     */
    protected bool $isProcessed = false;

    /**
     * Process the payment.
     *
     * @param  array  $payload
     *
     * @return bool
     */
    public function process(array $payload): bool
    {
        return $this->isProcessed = true;
    }

    /**
     * Get error details.
     *
     * @return array|null
     */
    public function getError(): ?array
    {
        return $this->error;
    }

    /**
     * Determine whether the payment has been processed.
     *
     * @return bool
     */
    public function isProcessed(): bool
    {
        return $this->isProcessed;
    }

    /**
     * Cancel payment.
     *
     * @return void
     */
    public function rollback(): void
    {
    }
}
