<?php

declare(strict_types=1);

/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015, 2016, 2017, 2018, 2019  Leon Jacobs
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace Seatplus\EsiClient\Log;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Seatplus\EsiClient\EsiConfiguration;

class RotatingFileLogger implements LogInterface
{
    protected Logger $logger;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $configuration = EsiConfiguration::getInstance();

        $formatter = new LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n");
        $logDir = rtrim($configuration->logfileLocation, '/');
        $stream = new RotatingFileHandler(
            "{$logDir}/esi-client.log",
            $configuration->logMaxFiles,
            (int) $configuration->loggerLevel
        );
        $stream->setFormatter($formatter);

        $this->logger = new Logger('esi-client');
        $this->logger->pushHandler($stream);
    }

    #[\Override]
    public function log(string $message): void
    {
        $this->logger->info($message);
    }

    #[\Override]
    public function debug(string $message): void
    {
        $this->logger->debug($message);
    }

    #[\Override]
    public function warning(string $message): void
    {
        $this->logger->warning($message);
    }

    #[\Override]
    public function error(string $message): void
    {
        $this->logger->error($message);
    }
}
