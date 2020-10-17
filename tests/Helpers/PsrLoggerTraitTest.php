<?php
/*
 * This file is part of the Bushido\Foundation package.
 *
 * (c) Wojciech Nowicki <wnowicki@me.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BushidoTests\Foundation\Helpers;

use Bushido\Foundation\Helpers\PsrLoggerTrait;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class PsrLoggerTraitTest extends TestCase
{
    use PsrLoggerTrait;

    /** @var LoggerInterface */
    private $logger;

    protected function getLogger(): ?LoggerInterface
    {
        return $this->logger;
    }

    public function testLogEmergency()
    {
        $this->logger = $this->createMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::EMERGENCY, '123', []);

        $this->logEmergency('123');
    }

    public function testLogAlert()
    {
        $this->logger = $this->createMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::ALERT, '123', []);

        $this->logAlert('123');
    }

    public function testLogCritical()
    {
        $this->logger = $this->createMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::CRITICAL, '123', []);

        $this->logCritical('123');
    }

    public function testLogError()
    {
        $this->logger = $this->createMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::ERROR, '123', []);

        $this->logError('123');
    }

    public function testLogWarning()
    {
        $this->logger = $this->createMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::WARNING, '123', []);

        $this->logWarning('123');
    }

    public function testLogNotice()
    {
        $this->logger = $this->createMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::NOTICE, '123', []);

        $this->logNotice('123');
    }

    public function testLogInfo()
    {
        $this->logger = $this->createMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::INFO, '123', []);

        $this->logInfo('123');
    }

    public function testLogDebug()
    {
        $this->logger = $this->createMock('Psr\Log\LoggerInterface');
        $this->logger->expects($this->once())
            ->method('log')
            ->with(LogLevel::DEBUG, '123', []);

        $this->logDebug('123');
    }
}
