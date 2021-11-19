<?php

namespace OhDear\HealthCheckReport;

use DateTime;
use DateTimeInterface;

class Report
{
    protected DateTimeInterface $finishedAt;

    /** @var array<int, Line> */
    protected array $lines;

    /**
     * @param \DateTimeInterface|null $finishedAt
     * @param array<int, Line> $lines
     */
    public function __construct(DateTimeInterface $finishedAt = null, array $lines = [])
    {
        $this->finishedAt = $finishedAt ?? new DateTime();

        $this->lines = $lines;
    }

    public function addLine(Line $lines)
    {
        $this->lines[] = $lines;
    }

    public function toJson(): string
    {
        $lines = array_map(fn (Line $line) => $line->toArray(), $this->lines);

        return json_encode([
            'finishedAt' => $this->finishedAt->format('Y-m-d H:i:s'),
            'lines' => $lines,
        ]);
    }
}
