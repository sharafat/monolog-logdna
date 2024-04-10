<?php

/*
 * This file is part of the ITakademy/Monolog package.
 *
 * (c) Nicolas Vanheuverzwijn <nicolas.vanheu@gmail.com>
 *
 * This is a fork of Nicolas Vanheuverzwijn's work for Monolog2 compatibility
 * Code by Jean-Baptiste MONIN <jb.monin@it-akademy.fr>, with thank's to Larry
 * Laski <larry.laski@gmail.com> for his job.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ITakademy\Monolog\Formatter;

/**
 * Encode records in a json format compatible with Logdna
 * @author Nicolas Vanheuverzwijn
 */
class LogdnaFormatter extends \Monolog\Formatter\JsonFormatter {

    public function __construct($batchMode = self::BATCH_MODE_NEWLINES, bool $appendNewline = false) {
        parent::__construct($batchMode, $appendNewline);
    }

    public function format($record): string {
        $date = new \DateTime();

        $json = [
            'lines' => [
                [
                    'timestamp' => $date->getTimestamp(),
                    'line' => $record['message'],
                    'app' => $record['channel'],
                    'level' => $record['level_name'],
                    'meta' => $record['context']
                ]
            ]
        ];

        return parent::format($json);
    }
}
