<?php

namespace halumein\consumption\interfaces;

interface Remain
{
    public function addRemain($income);
    public function setRemainOutcome($transaction);
    public function setNullCost($costModel);
    public function addCost($transaction_id, $income_id, $consume_amount, $date);
    public function updCost($costModel, $income_id, $consume_amount);
}