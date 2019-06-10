<?php

namespace Resiliency\Places;

use Resiliency\Contracts\Transaction;
use Resiliency\States;

/**
 * This state is manually triggered to ensure the Circuit Breaker
 * remains open until we reset it.
 */
class IsolatedPlace extends AbstractPlace
{
    public function __construct()
    {
        parent::__construct(0, 0.0, 0.0);
    }

    /**
     * {@inheritdoc}
     */
    public function getState(): string
    {
        return States::ISOLATED_STATE;
    }

    /**
     * {@inheritdoc}
     */
    public function call(Transaction $transaction, callable $fallback): string
    {
        return (string) $fallback();
    }
}
