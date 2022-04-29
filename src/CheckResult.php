<?php

namespace OhDear\HealthCheckResults;

class CheckResult
{
    public const STATUS_OK = 'ok';
    public const STATUS_WARNING = 'warning';
    public const STATUS_FAILED = 'failed';
    public const STATUS_CRASHED = 'crashed';
    public const STATUS_SKIPPED = 'skipped';

    /**
     * @param string $name
     * @param string $notificationMessage
     * @param string $shortSummary
     * @param string $status
     * @param array<int, mixed> $meta
     *
     * @return self
     */
    public static function make(
        string $name,
        string $label = '',
        string $notificationMessage = '',
        string $shortSummary = '',
        string $status = '',
        array  $meta = [],
    ): self {
        return new self(...func_get_args());
    }

    /**
     * @param string $name
     * @param string $notificationMessage
     * @param string $shortSummary
     * @param string $status
     * @param array<int, mixed> $meta
     */
    public function __construct(
        public string $name,
        public string $label = '',
        public string $notificationMessage = '',
        public string $shortSummary = '',
        public string $status = '',
        public array  $meta = [],
    ) {
    }

    public function notificationMessage(string $notificationMessage): self
    {
        $this->notificationMessage = $notificationMessage;

        return $this;
    }

    public function shortSummary(string $shortSummary): self
    {
        $this->shortSummary = $shortSummary;

        return $this;
    }

    public function status(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param array<int, mixed> $meta
     *
     * @return $this
     */
    public function meta(array $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'notificationMessage' => $this->notificationMessage,
            'shortSummary' => $this->shortSummary,
            'status' => $this->status,
            'meta' => $this->meta,
        ];
    }
}
