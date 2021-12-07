<?php

use OhDear\HealthCheckReport\CheckResult;
use OhDear\HealthCheckReport\CheckResults;
use function Spatie\Snapshots\assertMatchesJsonSnapshot;

it('can write health check results as json', function () {
    $checkResults = new CheckResults(DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00'));

    $checkResult = new CheckResult(
        name: 'UsedDiskSpace',
        label: 'Used disk space',
        notificationMessage: 'Your disk is almost full (91%)',
        shortSummary: '91%',
        status: CheckResult::STATUS_FAILED,
        meta: ['used_disk_space_percentage' => 91]
    );

    $checkResults
        ->addCheckResult($checkResult);

    assertMatchesJsonSnapshot($checkResults->toJson());
});

it('can convert JSON to health check results', function () {
    $stub = __DIR__ . '/stubs/storedHealthChecks.json';

    $jsonContent = file_get_contents($stub);

    $checkResults = CheckResults::fromJson($jsonContent);

    expect($checkResults->checkResults())->toHaveCount(1);
    expect($checkResults->checkResults()[0]->name)->toBe('UsedDiskSpace');
});
