<?php

function flightClassName(string $class): string
    {
        return [
            'economy' => 'Эконом',
            'business' => 'Бизнес',
            'first' => 'Первый',
        ][$class] ?? 'Неизвестно';
    }