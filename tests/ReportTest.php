<?php

use OhDear\HealthCheckReport\Line;
use OhDear\HealthCheckReport\Report;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('can create create report', function () {
    $report = getReport();

    assertMatchesSnapshot($report->toJson());
});

it('can be created from json', function () {
    $json = getReport()->toJson();

    $newReport = Report::fromJson($json);

    expect($newReport->toJson())->toBe($json);
});

function getReport(): Report
{
    $lines = [
        new Line(
            'name',
            'message',
            'ok',
            ['name' => 'value']
        ),
    ];

    return new Report(
        finishedAt: new DateTimeImmutable('2001-01-01 00:00:00'),
        lines: $lines,
    );
}
