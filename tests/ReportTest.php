<?php

use OhDear\HealthCheckReport\Line;
use OhDear\HealthCheckReport\Report;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('can create create report', function () {
    $lines = [
        new Line(
            'name',
            'message',
            'ok',
            ['name' => 'value']
        )
    ];

    $report = new Report(
        finishedAt: new DateTimeImmutable('2001-01-01 00:00:00'),
        lines: $lines,
    );

    assertMatchesSnapshot($report->toJson());
});
