<?php

declare(strict_types=1);

namespace Leevel\Encryption\Helper;

class DeepReplace
{
    /**
     * 深度过滤.
     */
    public static function handle(array $search, string $subject): string
    {
        $found = true;
        while ($found) {
            $found = false;
            foreach ($search as $val) {
                while (str_contains($subject, $val)) {
                    $found = true;
                    $subject = str_replace($val, '', $subject);
                }
            }
        }

        return $subject;
    }
}
