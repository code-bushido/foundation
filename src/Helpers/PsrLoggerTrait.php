<?php declare(strict_types=1);
/*
 * This file is part of the Bushido\Foundation package.
 *
 * (c) Wojciech Nowicki <wnowicki@me.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Bushido\Foundation\Helpers;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

trait PsrLoggerTrait
{
    abstract protected function getLogger(): ?LoggerInterface;

    protected function logEmergency(string $message, array $context = []): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    protected function logAlert(string $message, array $context = []): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    protected function logCritical(string $message, array $context = []): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    protected function logError(string $message, array $context = []): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    protected function logWarning(string $message, array $context = []): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    protected function logNotice(string $message, array $context = []): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    protected function logInfo(string $message, array $context = []): void
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    protected function logDebug(string $message, array $context = []): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    protected function log(string $level, string $message, array $context): void
    {
        if ($this->getLogger() instanceof LoggerInterface) {
            $this->getLogger()->log($level, $message, $context);
        }
    }
}
