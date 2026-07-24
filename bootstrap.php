<?php
declare(strict_types=1);

/**
 * =============================================================================
 * LDDI Security Shield Framework (LSS)
 * =============================================================================
 *
 * File........: bootstrap.php
 * Component...: Bootstrap Loader
 * Version.....: 1.0.1
 * PHP.........: >= 8.2
 *
 * Description:
 * Punto único de entrada del Framework.
 *
 * Responsibilities:
 *   - Verificar versión mínima de PHP.
 *   - Cargar constantes del Framework.
 *   - Registrar el Autoloader.
 *   - Inicializar la aplicación.
 *
 * This file MUST NOT contain business logic.
 *
 * =============================================================================
 */

if (!defined('LSS_ROOT')) {
    define('LSS_ROOT', '/opt/lss');
}

require_once LSS_ROOT . '/version.php';
require_once LSS_ROOT . '/autoload.php';

if (!class_exists(\LSS\Core\Application::class)) {
    throw new RuntimeException('Unable to load LSS Core Application.');
}

LSS\Core\Application::boot();