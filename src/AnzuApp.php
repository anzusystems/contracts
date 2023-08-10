<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts;

use AnzuSystems\Contracts\Exception\AnzuException;
use AnzuSystems\Contracts\Exception\AppReadOnlyModeException;
use DateTimeImmutable;
use RuntimeException;

class AnzuApp
{
    public const DATETIME_MIN = '1970-01-01 00:00:00';
    public const DATETIME_MAX = '2100-01-01 00:00:00';

    private static DateTimeImmutable $appDate;
    private static string $projectDir = '';
    private static string $pidDir;
    private static string $dataDir;
    private static string $downloadDir;
    private static string $appEnv;
    private static string $contextId = '';
    private static bool $initialized = false;
    private static bool $appReadOnlyMode;
    private static string $appNamespace;
    private static string $appSystem;
    private static string $appVersion;
    private static int $userIdAdmin;
    private static int $userIdConsole;
    private static int $userIdAnonymous;

    /**
     * Run at kernel boot.
     */
    public static function init(
        string $appCompany,
        string $appSystem,
        string $appVersion,
        bool $appReadOnlyMode,
        string $projectDir,
        string $appEnv,
        int $userIdAdmin = 1,
        int $userIdConsole = 2,
        int $userIdAnonymous = 3,
        string $contextId = '',
    ): void {
        self::$appNamespace = $appCompany;
        self::$appSystem = $appSystem;
        self::$appVersion = $appVersion;
        self::$appReadOnlyMode = $appReadOnlyMode;
        self::$initialized = true;
        self::$appDate = new DateTimeImmutable();
        self::$appEnv = $appEnv;
        self::$projectDir = $projectDir;
        self::$pidDir = self::$projectDir . '/var/pid';
        self::$dataDir = self::$projectDir . '/var/mnt/data';
        self::$downloadDir = self::$dataDir . '/download';
        self::$userIdAdmin = $userIdAdmin;
        self::$userIdConsole = $userIdConsole;
        self::$userIdAnonymous = $userIdAnonymous;
        self::$contextId = $contextId;
    }

    public static function getUserIdAdmin(): int
    {
        self::throwExceptionOnNotInitialized();

        return self::$userIdAdmin;
    }

    public static function getUserIdAnonymous(): int
    {
        self::throwExceptionOnNotInitialized();

        return self::$userIdAnonymous;
    }

    public static function getUserIdConsole(): int
    {
        self::throwExceptionOnNotInitialized();

        return self::$userIdConsole;
    }

    /**
     * Get context id from kernel or if wasn't set yet, generate a new context id.
     */
    public static function getContextId(): string
    {
        if ('' === self::$contextId) {
            self::$contextId = (string) uuid_create();
        }

        return self::$contextId;
    }

    public static function setContextId(string $contextId): void
    {
        self::$contextId = $contextId;
    }

    public static function getAppEnv(): string
    {
        self::throwExceptionOnNotInitialized();

        return self::$appEnv;
    }

    public static function getAppVersion(): string
    {
        self::throwExceptionOnNotInitialized();

        return self::$appVersion;
    }

    public static function getAppNamespace(): string
    {
        self::throwExceptionOnNotInitialized();

        return self::$appNamespace;
    }

    public static function getAppSystem(): string
    {
        self::throwExceptionOnNotInitialized();

        return self::$appSystem;
    }

    public static function getAppVersionWithSystem(): string
    {
        return sprintf('%s-%s', self::getAppSystem(), self::getAppVersion());
    }

    /**
     * Get IP address directly from HTTP_X_FORWARDED_FOR header.
     * Beware that this must be used only in case we allow only trusted proxy to access this app that sets this header.
     * If an attacker go around LB/proxy, he could potentially set this header to whatever he wants.
     */
    public static function getClientIp(): string
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0] ?? '';
        }

        return '';
    }

    public static function isReadOnlyMode(): bool
    {
        self::throwExceptionOnNotInitialized();

        return self::$appReadOnlyMode;
    }

    /**
     * @throws AppReadOnlyModeException
     */
    public static function throwOnReadOnlyMode(): void
    {
        if (self::isReadOnlyMode()) {
            throw new AppReadOnlyModeException();
        }
    }

    /**
     * Get dateTime of application boot.
     */
    public static function getAppDate(): DateTimeImmutable
    {
        self::throwExceptionOnNotInitialized();

        return self::$appDate;
    }

    /**
     * Create new DateTimeImmutable (or use appDate) without IDE warning of unhandled exception.
     *
     * @noinspection PhpUnhandledExceptionInspection
     */
    public static function date(?string $datetime = null): DateTimeImmutable
    {
        if (null === $datetime) {
            return self::getAppDate();
        }

        return new DateTimeImmutable($datetime);
    }

    /**
     * Get dateTime of start of unix epoch.
     */
    public static function getMinDate(): DateTimeImmutable
    {
        return new DateTimeImmutable(self::DATETIME_MIN);
    }

    /**
     * Get maximum agreed dateTime.
     */
    public static function getMaxDate(): DateTimeImmutable
    {
        return new DateTimeImmutable(self::DATETIME_MAX);
    }

    public static function getProjectDir(): string
    {
        self::throwExceptionOnNotInitialized();

        return self::$projectDir;
    }

    public static function getPidDir(): string
    {
        return self::getDir(self::$pidDir);
    }

    public static function getDataDir(): string
    {
        return self::getDir(self::$dataDir);
    }

    public static function getDownloadDir(): string
    {
        return self::getDir(self::$downloadDir);
    }

    protected static function getDir(string $dir): string
    {
        self::throwExceptionOnNotInitialized();

        if (is_dir($dir)) {
            return $dir;
        }
        if (false === mkdir($dir, 0_777, true) && false === is_dir($dir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }

        return $dir;
    }

    protected static function throwExceptionOnNotInitialized(): void
    {
        if (false === self::$initialized) {
            throw new AnzuException(sprintf(
                'Class "%s" needs to be initialized first.',
                self::class,
            ));
        }
    }
}
