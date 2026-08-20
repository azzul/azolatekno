<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResponsiveImg extends Component
{
    public $src;
    public $alt;
    public $loading;
    public $class;
    public $width;
    public $height;
    public $priority;
    public $srcset;
    public $sizes;

    public function __construct(
        $src,
        $alt = '',
        $loading = 'lazy',
        $class = ''
    ) {
        $this->src = $src;
        $this->alt = $alt;
        $this->loading = $loading;
        $this->class = $class;

        // Priority otomatis
        $this->priority = ($loading === 'eager') ? 'high' : 'auto';

        // Ambil dimensi asli file
        $path = public_path($src);
        if (file_exists($path)) {
            [$width, $height] = getimagesize($path);
            $this->width = $width;
            $this->height = $height;
        } else {
            $this->width = 700;
            $this->height = 500;
        }

        // Generate otomatis srcset (jika ada versi small/medium/large)
        $this->srcset = $this->generateSrcset($src);

        // Default responsive size
        $this->sizes = '(max-width: 400px) 100vw, (max-width: 700px) 50vw, 33vw';
    }

    private function generateSrcset($src)
    {
        $basename = basename($src);
        $folder = dirname($src);

        $small = public_path("$folder/small/$basename");
        $medium = public_path("$folder/medium/$basename");
        $large = public_path("$folder/large/$basename");

        $set = [];

        if (file_exists($small)) {
            $set[] = asset("$folder/small/$basename") . ' 400w';
        }
        if (file_exists($medium)) {
            $set[] = asset("$folder/medium/$basename") . ' 700w';
        }
        if (file_exists($large)) {
            $set[] = asset("$folder/large/$basename") . ' 1000w';
        }

        // fallback ke src tunggal
        return !empty($set) ? implode(', ', $set) : asset($src) . ' ' . $this->width . 'w';
    }

    public function render(): View|Closure|string
    {
        return view('components.responsive-img');
    }
}