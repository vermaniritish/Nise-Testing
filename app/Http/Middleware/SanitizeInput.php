<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SanitizeInput
{
    /**
     * Fields that are allowed to contain HTML.
     * Add editor fields here if required.
     */
    protected $except = [
         'description',
         'content',
         'body',
		 'description_hi',
         'content_hi',
         'body_hi',
    ];

    public function handle(Request $request, Closure $next)
    {
        $request->replace($this->sanitize($request->all()));

        return $next($request);
    }

    private function sanitize(array $data)
    {
        foreach ($data as $key => $value) {

            if (in_array($key, $this->except)) {
                continue;
            }

            if (is_array($value)) {
                $data[$key] = $this->sanitize($value);
                continue;
            }

            if (!is_string($value)) {
                continue;
            }

            $data[$key] = $this->clean($value);
        }

        return $data;
    }

    private function clean(string $value): string
    {
        // Decode HTML entities
        $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Remove NULL bytes
        $value = str_replace("\0", '', $value);

        // Remove invisible/control characters
        $value = preg_replace('/[\x00-\x1F\x7F]/u', '', $value);

        // Remove script/style blocks
        $value = preg_replace('#<script\b[^>]*>(.*?)</script>#is', '', $value);
        $value = preg_replace('#<style\b[^>]*>(.*?)</style>#is', '', $value);

        // Remove dangerous tags
        $dangerousTags = [
            'iframe',
            'object',
            'embed',
            'applet',
            'meta',
            'link',
            'base',
            'form',
            'input',
            'button',
            'textarea',
            'select',
            'option',
            'svg',
            'math',
            'video',
            'audio',
            'source'
        ];

        foreach ($dangerousTags as $tag) {
            $value = preg_replace(
                "#<{$tag}\b[^>]*>(.*?)</{$tag}>#is",
                '',
                $value
            );

            $value = preg_replace(
                "#<{$tag}\b[^>]*/?>#is",
                '',
                $value
            );
        }

        // Remove ALL inline event handlers
        $value = preg_replace(
            '/\son[a-z]+\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+)/i',
            '',
            $value
        );

        // Remove javascript:, vbscript:, data:, file:
        $value = preg_replace(
            '/(javascript|vbscript|data|file)\s*:/i',
            '',
            $value
        );

        // Remove CSS expressions
        $value = preg_replace('/expression\s*\(/i', '', $value);

        // Remove CSS url(javascript:)
        $value = preg_replace('/url\s*\(/i', '', $value);

        // Remove HTML comments
        $value = preg_replace('/<!--(.*?)-->/s', '', $value);

        // Remove all remaining HTML tags
        $value = strip_tags($value);

        // Encode special characters
        $value = htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        // Normalize spaces
        $value = preg_replace('/\s+/', ' ', $value);

        return trim($value);
    }
}