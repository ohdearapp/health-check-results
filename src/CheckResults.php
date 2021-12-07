<?php

namespace OhDear\HealthCheckResults;

use DateTime;
use DateTimeInterface;

class CheckResults
{
    protected DateTimeInterface $finishedAt;

    /** @var array<int, CheckResult> */
    protected array $checkResults;

    public static function fromJson(string $json): CheckResults
    {
        $properties = json_decode($json, true);

        $checkResults = array_map(
            fn (array $checkResultProperties) => new CheckResult(...$checkResultProperties),
            $properties['checkResults'],
        );

        return new self(
            finishedAt: (new DateTime())->setTimestamp($properties['finishedAt']),
            checkResults: $checkResults,
        );
    }

    /**
     * @param \DateTimeInterface|null $finishedAt
     * @param array<int, CheckResult> $checkResults
     */
    public function __construct(DateTimeInterface $finishedAt = null, array $checkResults = [])
    {
        $this->finishedAt = $finishedAt ?? new DateTime();

        $this->checkResults = $checkResults;
    }

    public function addCheckResult(CheckResult $checkResult): self
    {
        $this->checkResults[] = $checkResult;

        return $this;
    }

    /**
     * @return array<int, \OhDear\HealthCheckResults\CheckResult>
     */
    public function checkResults(): array
    {
        return $this->checkResults;
    }

    public function toJson(): string
    {
        $checkResults = array_map(fn (CheckResult $checkResult) => $checkResult->toArray(), $this->checkResults);

        return (string)json_encode([
            'finishedAt' => $this->finishedAt->getTimestamp(),
            'checkResults' => $checkResults,
        ]);
    }
}
