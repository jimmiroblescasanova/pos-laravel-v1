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

if (!function_exists('paymentMethod')) {
    function paymentMethod($type)
    {
        switch ($type) {
            case 1:
                return "Efectivo";
            case 2:
                return "Transferencia Electrónica";
            case 3:
                return "Tarjeta de Débito";
            case 4:
                return "Tarjeta de Crédito";
            case 99:
                return "Otro";
        }
    }
}

$paymentMethods = [
    1 => "Efectivo",
    2 => "Transferencia Electrónica",
    3 => "Tarjeta de Débito",
    4 => "Tarjeta de Crédito",
    99 => "Otro",
];