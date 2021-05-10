<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('vendor')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR1' => true,
        '@PSR2' => true,
        '@PSR12' => true,
        '@Symfony' => true,
        'method_chaining_indentation' => true,
        'multiline_whitespace_before_semicolons' => ['strategy' => 'new_line_for_chained_calls'],
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ternary_to_null_coalescing' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_order' => true,
    ])
    ->setFinder($finder)
;
