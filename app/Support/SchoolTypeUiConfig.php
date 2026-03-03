<?php

namespace App\Support;

class SchoolTypeUiConfig
{
    private const DEFAULT_SLUG = 'os';

    private const CONFIG = [
        'pv' => [
            'label' => 'Predšolska vzgoja',
            'shortLabel' => 'PV',
            'icon' => 'icon-regular.children',
            'badge' => 'bg-fuchsia-50 text-fuchsia-700 border-fuchsia-200 dark:bg-fuchsia-950/50 dark:text-fuchsia-300 dark:border-fuchsia-800',
            'filterActive' => 'border-fuchsia-400 bg-fuchsia-500 text-white',
            'latestFilterActive' => 'border-fuchsia-400 bg-fuchsia-500 text-white shadow-md shadow-fuchsia-200/50',
            'dot' => 'bg-fuchsia-500',
            'dotActive' => 'bg-white',
            'create' => [
                'bg' => 'bg-fuchsia-50 dark:bg-fuchsia-950/40',
                'border' => 'border-fuchsia-200 dark:border-fuchsia-800',
                'text' => 'text-fuchsia-700 dark:text-fuchsia-300',
                'active' => 'border-fuchsia-400 bg-fuchsia-500 text-white shadow-md dark:border-fuchsia-500 dark:bg-fuchsia-600',
                'checkBg' => 'bg-white/30 text-white',
                'checkBorder' => 'border-2 border-current opacity-30',
            ],
            'card' => [
                'title' => 'Predšolska vzgoja',
                'description' => 'Gradiva za vrtec in predšolsko obdobje',
                'gradient' => 'from-fuchsia-500 to-pink-500',
                'bgLight' => 'bg-fuchsia-50 dark:bg-fuchsia-950/30',
                'borderColor' => 'border-fuchsia-200 dark:border-fuchsia-800',
                'textColor' => 'text-fuchsia-700 dark:text-fuchsia-300',
                'iconBg' => 'bg-fuchsia-100 dark:bg-fuchsia-900/50',
                'iconColor' => 'text-fuchsia-600 dark:text-fuchsia-400',
                'badgeBg' => 'bg-fuchsia-100 text-fuchsia-700 dark:bg-fuchsia-900/50 dark:text-fuchsia-300',
                'hoverBorder' => 'hover:border-fuchsia-300 dark:hover:border-fuchsia-700',
                'shadowColor' => 'hover:shadow-fuchsia-100/50 dark:hover:shadow-fuchsia-900/30',
            ],
            'level' => [
                'bg' => 'bg-fuchsia-50 dark:bg-fuchsia-950/50',
                'text' => 'text-fuchsia-700 dark:text-fuchsia-300',
                'border' => 'border-fuchsia-200 dark:border-fuchsia-800',
                'dot' => 'bg-fuchsia-500',
                'icon' => 'bg-fuchsia-100 dark:bg-fuchsia-900/50 text-fuchsia-600 dark:text-fuchsia-400',
            ],
        ],
        'os' => [
            'label' => 'Osnovna šola',
            'shortLabel' => 'OS',
            'icon' => 'icon-regular.school',
            'badge' => 'bg-teal-50 text-teal-700 border-teal-200 dark:bg-teal-950/50 dark:text-teal-300 dark:border-teal-800',
            'filterActive' => 'border-teal-400 bg-teal-500 text-white',
            'latestFilterActive' => 'border-teal-400 bg-teal-500 text-white shadow-md shadow-teal-200/50',
            'dot' => 'bg-teal-500',
            'dotActive' => 'bg-white',
            'create' => [
                'bg' => 'bg-teal-50 dark:bg-teal-950/40',
                'border' => 'border-teal-200 dark:border-teal-800',
                'text' => 'text-teal-700 dark:text-teal-300',
                'active' => 'border-teal-400 bg-teal-500 text-white shadow-md dark:border-teal-500 dark:bg-teal-600',
                'checkBg' => 'bg-white/30 text-white',
                'checkBorder' => 'border-2 border-current opacity-30',
            ],
            'card' => [
                'title' => 'Osnovna šola',
                'description' => 'Gradiva za 1. do 9. razred osnovne šole',
                'gradient' => 'from-teal-500 to-emerald-500',
                'bgLight' => 'bg-teal-50 dark:bg-teal-950/30',
                'borderColor' => 'border-teal-200 dark:border-teal-800',
                'textColor' => 'text-teal-700 dark:text-teal-300',
                'iconBg' => 'bg-teal-100 dark:bg-teal-900/50',
                'iconColor' => 'text-teal-600 dark:text-teal-400',
                'badgeBg' => 'bg-teal-100 text-teal-700 dark:bg-teal-900/50 dark:text-teal-300',
                'hoverBorder' => 'hover:border-teal-300 dark:hover:border-teal-700',
                'shadowColor' => 'hover:shadow-teal-100/50 dark:hover:shadow-teal-900/30',
            ],
            'level' => [
                'bg' => 'bg-teal-50 dark:bg-teal-950/50',
                'text' => 'text-teal-700 dark:text-teal-300',
                'border' => 'border-teal-200 dark:border-teal-800',
                'dot' => 'bg-teal-500',
                'icon' => 'bg-teal-100 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400',
            ],
        ],
        'ss' => [
            'label' => 'Srednja šola',
            'shortLabel' => 'SŠ',
            'icon' => 'icon-regular.graduation-cap',
            'badge' => 'bg-orange-50 text-orange-700 border-orange-200 dark:bg-orange-950/50 dark:text-orange-300 dark:border-orange-800',
            'filterActive' => 'border-orange-400 bg-orange-500 text-white',
            'latestFilterActive' => 'border-orange-400 bg-orange-500 text-white shadow-md shadow-orange-200/50',
            'dot' => 'bg-orange-500',
            'dotActive' => 'bg-white',
            'create' => [
                'bg' => 'bg-orange-50 dark:bg-orange-950/40',
                'border' => 'border-orange-200 dark:border-orange-800',
                'text' => 'text-orange-700 dark:text-orange-300',
                'active' => 'border-orange-400 bg-orange-500 text-white shadow-md dark:border-orange-500 dark:bg-orange-600',
                'checkBg' => 'bg-white/30 text-white',
                'checkBorder' => 'border-2 border-current opacity-30',
            ],
            'card' => [
                'title' => 'Srednja šola',
                'description' => 'Gradiva za gimnazije in srednje šole',
                'gradient' => 'from-orange-500 to-amber-500',
                'bgLight' => 'bg-orange-50 dark:bg-orange-950/30',
                'borderColor' => 'border-orange-200 dark:border-orange-800',
                'textColor' => 'text-orange-700 dark:text-orange-300',
                'iconBg' => 'bg-orange-100 dark:bg-orange-900/50',
                'iconColor' => 'text-orange-600 dark:text-orange-400',
                'badgeBg' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/50 dark:text-orange-300',
                'hoverBorder' => 'hover:border-orange-300 dark:hover:border-orange-700',
                'shadowColor' => 'hover:shadow-orange-100/50 dark:hover:shadow-orange-900/30',
            ],
            'level' => [
                'bg' => 'bg-orange-50 dark:bg-orange-950/50',
                'text' => 'text-orange-700 dark:text-orange-300',
                'border' => 'border-orange-200 dark:border-orange-800',
                'dot' => 'bg-orange-500',
                'icon' => 'bg-orange-100 dark:bg-orange-900/50 text-orange-600 dark:text-orange-400',
            ],
        ],
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return self::CONFIG;
    }

    /**
     * @return array<string, mixed>
     */
    public static function forSlug(?string $slug): array
    {
        $normalizedSlug = strtolower(trim((string) $slug));

        return self::CONFIG[$normalizedSlug] ?? self::CONFIG[self::DEFAULT_SLUG];
    }
}
