<?php

namespace PCCFramework\Intervention;

use function \Sober\Intervention\intervention;

function apply_interventions()
{
    if (function_exists('\Sober\Intervention\intervention')) {
        intervention('remove-customizer-items', 'custom-css');
        intervention('remove-dashboard-items', ['news', 'welcome']);
        intervention('remove-emoji');
        intervention('remove-howdy');
    }
}
