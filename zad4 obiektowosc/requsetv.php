<?php
class RequestValidator {
    private array $errors = [];

    public function validate(array $data): bool {
        if (!isset($data['amount']) || $data['amount'] === "") {
            $this->errors[] = "Nie podano kwoty kredytu.";
        } elseif (!is_numeric($data['amount'])) {
            $this->errors[] = "Kwota kredytu musi być liczbą.";
        }

        if (!isset($data['years']) || $data['years'] === "") {
            $this->errors[] = "Nie podano okresu spłaty.";
        } elseif (!is_numeric($data['years'])) {
            $this->errors[] = "Okres spłaty musi być liczbą.";
        }

        if (!isset($data['interest']) || $data['interest'] === "") {
            $this->errors[] = "Nie podano oprocentowania.";
        } elseif (!is_numeric($data['interest'])) {
            $this->errors[] = "Oprocentowanie musi być liczbą.";
        }

        return empty($this->errors);
    }

    public function getErrors(): array {
        return $this->errors;
    }
}