<?php

declare(strict_types=1);

namespace Leevel\Encryption\Helper;

class CleanJs
{
    /**
     * 过滤 JavaScript.
     */
    public static function handle(string $strings): string
    {
        $strings = trim($strings);
        $strings = stripslashes($strings);
        // 完全过滤注释
        $strings = (string) preg_replace('/<!--?.*-->/', '', $strings);
        // 完全过滤动态代码
        $strings = (string) preg_replace('/<\?|\?>/', '', $strings);
        // 完全过滤 js
        $strings = (string) preg_replace('/<script?.*\/script>/', '', $strings);
        // 过滤多余 html
        $strings = (string) preg_replace('/<\/?(html|head|meta|link|base|body|title|style|script|form|iframe|frame|frameset)[^><]*>/i', '', $strings);
        // 过滤 on 事件
        while (preg_match('/(<[^><]+)(lang|onfinish|onmouse|onexit|onerror|onclick|onkey|onload|onchange|onfocus|onblur)[^><]+/i', $strings, $matches)) {
            $strings = str_replace($matches[0], $matches[1], $strings);
        }

        while (preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i', $strings, $matches)) {
            $strings = str_replace($matches[0], $matches[1].$matches[3], $strings);
        }

        return $strings;
    }
}
