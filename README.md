# Money Example

A PHP implementation of the Money Example from Kent Beck's *Test-Driven Development: By Example*.

The project was developed incrementally following the TDD workflow from the example:

1. Write a test.
2. Run the tests and see it fail.
3. Make the smallest change necessary.
4. Run the tests and make them pass.
5. Refactor.

## Requirements

- PHP 8.x
- Composer
- PHPUnit 11

## Installation

Clone the repository and install the dependencies:

```bash
git clone <repository-url>
cd Money-Example
composer install
```

## Running the tests

```bash
./vendor/bin/phpunit
```

On Windows:

```bash
vendor\bin\phpunit
```

## Concepts covered

The implementation progressively introduces:

- Money as a Value Object
- Multiplication
- Equality
- Multiple currencies
- Currency conversion
- Addition
- Expressions
- Sums
- Exchange rates
- Reduction
- Composite expressions
- TDD-driven refactoring

## Structure

```text
src/
├── Bank.php
├── Expression.php
├── Money.php
└── Sum.php

tests/
└── MoneyTest.php
```

## Reference

Based on the Money Example from:

Kent Beck — *Test-Driven Development: By Example*

The goal of this repository is to practice TDD, incremental design, refactoring, and object-oriented design rather than to provide a production-ready money library.
