<?php

if (!function_exists('setBadge')) {
    function setBadge($state)
    {
        if ($state) {
            return '<span class="badge badge-success">En uso</span>';
        } else {
            return '<span class="badge badge-danger">Inactivo</span>';
        }
    }
}

if (!function_exists('accounting')) {
    function accounting($number)
    {
        return "$ " . number_format($number, 2);
    }
}