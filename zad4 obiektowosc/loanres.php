<?php
class LoanResult {
    private ?float $monthlyPayment = null;
    private array $errors = [];

    public function setMonthlyPayment(float $payment): void {
        $this->monthlyPayment = $payment;
    }

    public function getMonthlyPayment(): ?float {
        return $this->monthlyPayment;
    }

    public function setErrors(array $errors): void {
        $this->errors = $errors;
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function hasErrors(): bool {
        return !empty($this->errors);
    }
}
