<?php
class LoanCalculator {
    private float $amount;
    private int $years;
    private float $interest;

    public function __construct(float $amount, int $years, float $interest) {
        $this->amount = $amount;
        $this->years = $years;
        $this->interest = $interest;
    }

    /**
     * Oblicza miesięczną ratę kredytu.
     * @return float
     */
    public function calculateMonthlyPayment(): float {
        $monthlyInterest = $this->interest / 12 / 100;
        $months = $this->years * 12;

        if ($monthlyInterest > 0) {
            return $this->amount * ($monthlyInterest / (1 - pow(1 + $monthlyInterest, -$months)));
        } else {
            return $this->amount / $months;
        }
    }
}