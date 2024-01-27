<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
class TransactionsTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;

    public function test_transaction_create()
    {

        $this->assertTrue(true);

    }
}
