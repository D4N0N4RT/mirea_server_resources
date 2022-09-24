<?php

class Drawer {
    const SQUARE = 0b00;
    const CIRCLE = 0b01;
    const TRIANGLE = 0b10;
    const TRAPEZE = 0b11;
    const COLORS = [
        0b00 => 'green',
        0b01 => 'blue',
        0b10 => 'red',
        0b11 => 'yellow'
    ];
    private int $shape;
    private string $color;
    private int $width;
    private int $height;

    public function __construct(int $encoded) {
        $this->shape = ($encoded & 0b11000000) >> 6;
        $this->height = (($encoded & 0b00110000) >> 4) * 40;
        $this->width = (($encoded & 0b00001100) >> 2) * 40;
        $color = $encoded & 0b00000011;
        if ($this->height <= 0 || $this->width <= 0)
            echo 'Неправильный параметр (Высота и ширина должны быть больше нуля)';
        else {
            $this->color = self::COLORS[$color];
            $this->draw();
        }
    }

    private function draw() {
        $halfW = $this->width / 2;
        $quarterW = $halfW / 2;
        $threequarters = $quarterW + $halfW;
        $halfH = $this->height / 2;
        if ($halfH < $halfW) $half = $halfH;
        else $half = $halfW;
        $figure = match ($this->shape) {
            self::SQUARE => <<<A
                <rect 
                    width="$this->width" 
                    height="$this->height" 
                    fill="$this->color"/>
            A,
            self::CIRCLE => <<<B
                <circle 
                    cx="$half" 
                    cy="$half" 
                    r="$half" 
                    fill="$this->color"/>
            B,
            self::TRIANGLE => <<<C
                <polygon 
                    points=" $halfW,0 0,$this->height $this->width,$this->height" 
                    fill="$this->color"/>
            C,
            self::TRAPEZE => <<<D
                <polygon 
                    points=" 0,$this->height $quarterW,0 $threequarters,0 $this->width,$this->height" 
                    fill="$this->color"/>
            D,
            default => 'Not found',
        };
        echo <<<E
        <svg 
            width="$this->width"
            height="$this->height">
            $figure
        </svg>                
        E;
    }
}

?>