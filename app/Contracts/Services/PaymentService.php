<?php

declare(strict_types=1);

namespace App\Contracts\Services;

interface PaymentService
{
    /**
     * Process the payment.
     *
     * @param  array  $payload
     *
     * @return bool
     */
    public function process(array $payload): bool;

    /**
     * Get error details.
     *
     * @return array|null
     */
    public function getError(): ?array;

    /**
     * Determine whether the payment has been processed.
     *
     * @return bool
     */
    public function isProcessed(): bool;

    /**
     * Cancel payment.
     *
     * @return void
     */
    public function rollback(): void;
}
