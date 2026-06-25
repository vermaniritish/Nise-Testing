<?php

namespace App\Http\Middleware;

use Closure;

class SanitizeInput
{
    public function handle($request, Closure $next)
    {
        $input = $this->sanitize($request->all());

        $request->replace($input);

        return $next($request);
    }

    private function sanitize($data)
    {
        foreach ($data as $key => $value) {

            if (is_array($value)) {
                $data[$key] = $this->sanitize($value);
                continue;
            }

            if (!is_string($value)) {
                continue;
            }

            // Remove script tags
            $value = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $value);

            // Remove dangerous event handlers
            $value = preg_replace(
                '/\s(onload|onerror|onclick|onmouseover|onfocus|onblur|onchange)\s*=\s*([^\s>]*)/i',
                '',
                $value
            );

            // Remove javascript:, vbscript:, data:
            $value = preg_replace(
                '/(javascript:|vbscript:|data:)/i',
                '',
                $value
            );

            // Remove iframe/object/embed
            $value = preg_replace(
                '/<(iframe|object|embed|applet|meta|link)(.*?)>/is',
                '',
                $value
            );

            $data[$key] = trim($value);
        }

        return $data;
    }
}