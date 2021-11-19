<?php

namespace OhDear\HealthCheckReport;

use DateTime;
use DateTimeInterface;

class Report
{
    protected DateTimeInterface $finishedAt;

    /** @var array<int, Line> */
    protected array $lines;

    public static function fromJson(string $json): Report
    {
        $properties = json_decode($json, true);

        $lines = array_map(
            fn (array $lineProperties) => new Line(...$lineProperties),
            $properties['lines'],
        );

        return new static(
            finishedAt: new DateTime($properties['finishedAt']),
            lines: $lines,
        );
    }

    /**
     * @param \DateTimeInterface|null $finishedAt
     * @param array<int, Line> $lines
     */
    public function __construct(DateTimeInterface $finishedAt = null, array $lines = [])
    {
        $this->finishedAt = $finishedAt ?? new DateTime();

        $this->lines = $lines;
    }

    public function addLine(Line $line): self
    {
        $this->lines[] = $line;

        return $this;
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
