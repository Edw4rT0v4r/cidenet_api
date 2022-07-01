<?php

$finder = PhpCsFixer\Finder::create()
    ->in('app/')
    ->in('config/')
    ->in('database/')
    ->in('routes/')
    ->in('src/')
    ->in('tests/');

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PSR2' => true,
    '@PhpCsFixer' => true,
    'declare_strict_types' => true,
    'array_syntax' => ['syntax' => 'short'],
    'phpdoc_line_span' => ['property' => 'single'],
    'php_unit_test_class_requires_covers' => false,
    'php_unit_method_casing' => ['case' => 'snake_case'],
    'class_attributes_separation' => [],
    'visibility_required' => [],
])
    ->setRiskyAllowed(true)
    ->setFinder($finder);
