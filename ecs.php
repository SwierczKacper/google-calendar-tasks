<?php

declare(strict_types=1);

//clean-code.php
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ClassNotation\ProtectedToPrivateFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededControlParenthesesFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededCurlyBracesFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer;

//php80-migration.php
use PhpCsFixer\Fixer\CastNotation\NoUnsetCastFixer;
use PhpCsFixer\Fixer\ArrayNotation\NormalizeIndexBraceFixer;
use PhpCsFixer\Fixer\Operator\TernaryToNullCoalescingFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;

//psr12.php
use PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\Basic\BracesFixer;
use PhpCsFixer\Fixer\CastNotation\LowercaseCastFixer;
use PhpCsFixer\Fixer\CastNotation\ShortScalarCastFixer;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer;
use PhpCsFixer\Fixer\Import\SingleImportPerStatementFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\NewWithBracesFixer;
use PhpCsFixer\Fixer\Operator\TernaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Whitespace\NoTrailingWhitespaceFixer;

//common/array.php
use PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrailingCommaInMultilineArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\StandaloneLineInMultilineArrayFixer;

//common/comments.php
use PHP_CodeSniffer\Standards\Generic\Sniffs\VersionControl\GitMergeConflictSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\TodoSniff; //https://github.com/squizlabs/PHP_CodeSniffer/blob/master/src/Standards/Generic/Sniffs/Commenting/TodoSniff.php

//common/control-structures.php
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PhpCsFixer\Fixer\Casing\MagicConstantCasingFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassDefinitionFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ClassNotation\SelfAccessorFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleClassElementPerStatementFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUselessElseFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\ControlStructure\NoSuperfluousElseifFixer;
use PhpCsFixer\Fixer\ControlStructure\NoTrailingCommaInListCallFixer;
use PhpCsFixer\Fixer\LanguageConstruct\ExplicitIndirectVariableFixer;
use PhpCsFixer\Fixer\LanguageConstruct\FunctionToConstantFixer;
use PhpCsFixer\Fixer\Operator\StandardizeIncrementFixer;
use PhpCsFixer\Fixer\StringNotation\ExplicitStringVariableFixer;
use Symplify\CodingStandard\Fixer\Spacing\MethodChainingNewlineFixer;
use PhpCsFixer\Fixer\Alias\NoMixedEchoPrintFixer;

//common/docblock.php
use PhpCsFixer\Fixer\Comment\NoTrailingWhitespaceInCommentFixer;
use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocLineSpanFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocReturnSelfReferenceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimConsecutiveBlankLineSeparationFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTypesFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarWithoutNameFixer;
use Symplify\CodingStandard\Fixer\Commenting\RemoveUselessDefaultCommentFixer;

//common/namespaces.php
use PhpCsFixer\Fixer\NamespaceNotation\SingleBlankLineBeforeNamespaceFixer;

//common/spaces.php
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\LanguageConstructSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\SuperfluousWhitespaceSniff;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleTraitInsertPerStatementFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionTypehintSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\NoLeadingNamespaceWhitespaceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSingleLineVarSpacingFixer;
use PhpCsFixer\Fixer\Semicolon\SpaceAfterSemicolonFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\NoSpacesAroundOffsetFixer;
use PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer;
use Symplify\CodingStandard\Fixer\Spacing\StandaloneLinePromotedPropertyFixer;

//common/strict.php
// use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
// use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
// use PhpCsFixer\Fixer\Strict\StrictParamFixer;

//php_cs_fixer/php-cs-fixer-psr2.php
use PhpCsFixer\Fixer\Basic\EncodingFixer;
use PhpCsFixer\Fixer\Casing\ConstantCaseFixer;
use PhpCsFixer\Fixer\Casing\LowercaseKeywordsFixer;
use PhpCsFixer\Fixer\ControlStructure\ElseifFixer;
use PhpCsFixer\Fixer\ControlStructure\NoBreakCommentFixer;
use PhpCsFixer\Fixer\ControlStructure\SwitchCaseSemicolonToColonFixer;
use PhpCsFixer\Fixer\ControlStructure\SwitchCaseSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoSpacesAfterFunctionNameFixer;
use PhpCsFixer\Fixer\Import\SingleLineAfterImportsFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer;
use PhpCsFixer\Fixer\PhpTag\FullOpeningTagFixer;
use PhpCsFixer\Fixer\PhpTag\NoClosingTagFixer;
use PhpCsFixer\Fixer\Whitespace\IndentationTypeFixer;
use PhpCsFixer\Fixer\Whitespace\LineEndingFixer;
use PhpCsFixer\Fixer\Whitespace\NoSpacesInsideParenthesisFixer;
use PhpCsFixer\Fixer\Whitespace\SingleBlankLineAtEofFixer;


use PhpCsFixer\Fixer\FunctionNotation\PhpdocToParamTypeFixer;
use PhpCsFixer\Fixer\FunctionNotation\PhpdocToReturnTypeFixer;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    //https://github.com/symplify/coding-standard/blob/main/docs/rules_overview.md
    //https://github.com/squizlabs/PHP_CodeSniffer/tree/master/src/
    //https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/index.rst

    $services = $containerConfigurator->services();

    $services->set(PhpdocToReturnTypeFixer::class);
    $services->set(PhpdocToParamTypeFixer::class);

    //common/array.php starts here

    //In array declaration, there MUST NOT be a whitespace before each comma. array(1 , "2") => array(1, "2")
    $services->set(NoWhitespaceBeforeCommaInArrayFixer::class);

    //Indexed PHP array opener [ and closer ] must be on own line
     $services->set(ArrayOpenerAndCloserNewlineFixer::class);

    //Each element of an array must be indented exactly once. https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/whitespace/array_indentation.rst
    $services->set(ArrayIndentationFixer::class);

    //Arrays should be formatted like function/method arguments, without leading or trailing single line space.
    $services->set(TrimArraySpacesFixer::class);

    //In array declaration, there MUST be a whitespace after each comma. array(1,'a',$b,); => array(1, 'a', $b, );
    $services->set(WhitespaceAfterCommaInArrayFixer::class);

    //Indexed PHP array item has to have one line per item
    // $services->set(ArrayListItemNewlineFixer::class);

    //Indexed arrays must have 1 item per line
     $services->set(StandaloneLineInMultilineArrayFixer::class);

    //PHP multi-line arrays should have a trailing comma. https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/array_notation/trailing_comma_in_multiline_array.rst
    $services->set(TrailingCommaInMultilineArrayFixer::class);

    //PHP single-line arrays should not have trailing comma. https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/array_notation/no_trailing_comma_in_singleline_array.rst
    $services->set(NoTrailingCommaInSinglelineArrayFixer::class);

    //common/comments.php starts here

    //Check for merge conflict artefacts.
    $services->set(GitMergeConflictSniff::class);

    //warns about todo comments
    $services->set(TodoSniff::class);

    //common/control-structures.php starts here

    //Each chain method call must be on own line https://github.com/symplify/coding-standard/blob/main/docs/rules_overview.md
    $services->set(MethodChainingNewlineFixer::class);

    //Either language construct print or echo should be used. https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/3.0/doc/rules/alias/no_mixed_echo_print.rst
    $services->set(NoMixedEchoPrintFixer::class);

    //$services->set(PhpUnitMethodCasingFixer::class);

    // Replace core functions calls returning constants with the constants.
    // Warning
    // Using this rule is risky.
    // Risky when any of the configured functions to replace are overridden.
    $services->set(FunctionToConstantFixer::class);

    //Converts implicit variables into explicit ones in double-quoted strings or heredoc syntax. https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/string_notation/explicit_string_variable.rst
    $services->set(ExplicitStringVariableFixer::class);

    //Add curly braces to indirect variables to make them clear to understand. Requires PHP >= 7.0. https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/language_construct/explicit_indirect_variable.rst
    $services->set(ExplicitIndirectVariableFixer::class);

    //All instances created with new keyword must be followed by braces. [new X => new X();]
    $services->set(NewWithBracesFixer::class);

    //Increment and decrement operators should be used if possible. $i += 1; => $++;
    $services->set(StandardizeIncrementFixer::class);

    //Inside class or interface element self should be preferred to the class name itself. https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/class_notation/self_accessor.rst
    $services->set(SelfAccessorFixer::class);

    //Magic constants should be referred to using the correct casing. __dir__ => __DIR__
    $services->set(MagicConstantCasingFixer::class);

    //Detects variable assignments being made within conditions.
    $services->set(AssignmentInConditionSniff::class);

    //There should not be useless else cases.
    $services->set(NoUselessElseFixer::class);

    //Convert double quotes to single quotes for simple strings.
    // $services->set(SingleQuoteFixer::class);

    //Write conditions in Yoda style (true), non-Yoda style (['equal' => false, 'identical' => false, 'less_and_greater' => false]) or ignore those conditions (null) based on configuration. https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/control_structure/yoda_style.rst
    $services->set(YodaStyleFixer::class)
        ->call('configure', [[ // Enforce non-Yoda style.
            'equal' => false,
            'identical' => false,
            'less_and_greater' => false,
        ]]);

    //Replaces superfluous elseif with if.
    $services->set(NoSuperfluousElseifFixer::class);

    //Remove trailing commas in list function calls.
    $services->set(NoTrailingCommaInListCallFixer::class);

    //Orders the elements of classes/interfaces/traits.
    $services->set(OrderedClassElementsFixer::class);

    //common/docblock.php

    //Changes doc blocks from single to multi line, or reversed. Works for class constants, properties and methods only.
    $services->set(PhpdocLineSpanFixer::class);

    //Removes extra blank lines after summary and after description in PHPDoc.
    $services->set(PhpdocTrimConsecutiveBlankLineSeparationFixer::class);

    //PHPDoc should start and end with content, excluding the very first and last line of the docblocks.
    $services->set(PhpdocTrimFixer::class);

    //There should not be empty PHPDoc blocks.
    $services->set(NoEmptyPhpdocFixer::class);

    //@return void and @return null annotations should be omitted from PHPDoc.
    $services->set(PhpdocNoEmptyReturnFixer::class);

    //Docblocks should have the same indentation as the documented subject.
    $services->set(PhpdocIndentFixer::class);

    //The correct case must be used for standard PHP types in PHPDoc.
    $services->set(PhpdocTypesFixer::class);

    //The type of @return annotations of methods returning a reference to itself must the configured one.
    $services->set(PhpdocReturnSelfReferenceFixer::class);

    //@var and @type annotations of classy properties should not contain the name.
    $services->set(PhpdocVarWithoutNameFixer::class);

    //Remove useless PHPStorm-generated @todo comments, redundant "Class XY" or "gets service" comments etc.
    $services->set(RemoveUselessDefaultCommentFixer::class);

    //Removes @param, @return and @var tags that don't provide any useful information.
    $services->set(NoSuperfluousPhpdocTagsFixer::class)
        ->call('configure', [
            [
                'remove_inheritdoc' => true,
                'allow_mixed' => true,
            ],
        ]);

    //common/namespaces.php starts here

    //Unused use statements must be removed.
    $services->set(NoUnusedImportsFixer::class);

    //Ordering use statements.
    $services->set(OrderedImportsFixer::class)->call('configure', [[
        'imports_order' => ['class', 'function', 'const'],
    ]]);

    //There should be exactly one blank line before a namespace declaration.
    $services->set(SingleBlankLineBeforeNamespaceFixer::class);

    //common/spaces.php starts here

    //Promoted property should be on standalone line https://github.com/symplify/coding-standard/blob/main/docs/rules_overview.md
    $services->set(StandaloneLinePromotedPropertyFixer::class);

    //Method chaining MUST be properly indented. Method chaining with different levels of indentation is not supported.
    $services->set(MethodChainingIndentationFixer::class);

    //Class, trait and interface elements must be separated with one or none blank line.
    $services->set(ClassAttributesSeparationFixer::class);

    //https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/operator/concat_space.rst
    $services->set(ConcatSpaceFixer::class)->call('configure', [[
        'spacing' => 'one', //$foo = 'bar' . 3 . 'baz'.'qux'; => $foo = 'bar' . 3 . 'baz'.'qux';
    ]]);

    //Logical NOT operators (!) should have one trailing whitespace.
    // $services->set(NotOperatorWithSuccessorSpaceFixer::class);

    //Checks for unneeded whitespace.
    $services->set(SuperfluousWhitespaceSniff::class)->property('ignoreBlankLines', false);

    //A single space or none should be between cast and variable.
    $services->set(CastSpacesFixer::class); //(int)$b; => (int) $b;

    //Binary operators should be surrounded by space as configured.
    $services->set(BinaryOperatorSpacesFixer::class)
        ->call('configure', [[
            'operators' => [
                '=>' => 'single_space',
                '=' => 'single_space',
            ],
        ]]);

    //Each trait "use" must be done as single statement.
    $services->set(SingleTraitInsertPerStatementFixer::class);

    //Ensure single space between function's argument and its typehint.
    $services->set(FunctionTypehintSpaceFixer::class);

    //There should be no empty lines after class opening brace.
    $services->set(NoBlankLinesAfterClassOpeningFixer::class);

    //Single-line whitespace before closing semicolon are prohibited. $this->foo() ; => $this->foo();
    $services->set(NoSinglelineWhitespaceBeforeSemicolonsFixer::class);

    //Single line @var PHPDoc should have proper spacing.
    $services->set(PhpdocSingleLineVarSpacingFixer::class);

    //The namespace declaration line shouldn't contain leading whitespace.
    $services->set(NoLeadingNamespaceWhitespaceFixer::class);

    //There MUST NOT be spaces around offset braces. https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/3.0/doc/rules/whitespace/no_spaces_around_offset.rst
    $services->set(NoSpacesAroundOffsetFixer::class);

    //Remove trailing whitespace at the end of blank lines.
    $services->set(NoWhitespaceInBlankLineFixer::class);

    //There should be one or no space before colon, and one space after it in return type declarations, according to configuration.
    //function foo(int $a):string {}; => function foo(int $a): string {};
    $services->set(ReturnTypeDeclarationFixer::class);

    //Fix whitespace after a semicolon.
    $services->set(SpaceAfterSemicolonFixer::class);

    //Standardize spaces around ternary operator.
    $services->set(TernaryOperatorSpacesFixer::class);

    //Ensures all language constructs contain a single space between themselves and their content.
    $services->set(LanguageConstructSpacingSniff::class);

    //common/strict.php starts here

    //Comparisons should be strict.
    // $services->set(StrictComparisonFixer::class);

    //Replaces is_null($var) expression with null === $var.
    // $services->set(IsNullFixer::class)->call('configure', [[
    //         'use_yoda_style' => false,
    // ]]);

    //Functions should be used with $strict param set to true.
    // $services->set(StrictParamFixer::class);

    //php_cs_fixer/php-cs-fixer-psr2.php starts here

    //PHP code MUST use only UTF-8 without BOM (remove BOM).
    $services->set(EncodingFixer::class);

    //PHP code must use the long <?php tags or short-echo <?= tags and not other tag variations.
    $services->set(FullOpeningTagFixer::class);

    //There MUST be one blank line after the namespace declaration.
    $services->set(BlankLineAfterNamespaceFixer::class);

    //braces {   } https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/3.0/doc/rules/basic/braces.rst
    $services->set(BracesFixer::class)->call('configure', [[
        'allow_single_line_anonymous_class_with_empty_body' => true,
        'allow_single_line_closure' => true,
        'position_after_functions_and_oop_constructs' => 'next', //after classes
        'position_after_control_structures' => 'same', //after if, elseif, return, foreach
        'position_after_anonymous_constructs' => 'same', //after anonymous functions eg. return function() {}
    ]]);

    //Whitespace around the keywords of a class, trait or interfaces definition should be one space. https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/class_notation/class_definition.rst
    $services->set(ClassDefinitionFixer::class);

    //The PHP constants true, false, and null MUST be written using the correct casing.
    $services->set(ConstantCaseFixer::class);

    //The keyword elseif should be used instead of else if so that all control keywords look like single words.
    $services->set(ElseifFixer::class);

    //Spaces should be properly placed in a function declaration.
    $services->set(FunctionDeclarationFixer::class);

    //Code MUST use configured indentation type.
    $services->set(IndentationTypeFixer::class);

    //All PHP files must use same line ending.
    $services->set(LineEndingFixer::class);

    //PHP keywords MUST be in lower case.
    $services->set(LowercaseKeywordsFixer::class);

    //https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/function_notation/method_argument_space.rst
    $services->set(MethodArgumentSpaceFixer::class);

    //There must be a comment when fall-through is intentional in a non-empty case body. Adds a "no break" comment before fall-through cases, and removes it if there is no fall-through.
    $services->set(NoBreakCommentFixer::class);

    //The php closing tag MUST be omitted from files containing only PHP.
    $services->set(NoClosingTagFixer::class);

    //When making a method or function call, there MUST NOT be a space between the method or function name and the opening parenthesis.
    $services->set(NoSpacesAfterFunctionNameFixer::class);

    //There MUST NOT be a space after the opening parenthesis. There MUST NOT be a space before the closing parenthesis.
    $services->set(NoSpacesInsideParenthesisFixer::class);

    /** There must be no trailing whitespace in strings.
    Warning
    Using this rule is risky.
    Changing the whitespaces in strings might affect string comparisons and outputs.
     */
    $services->set(NoTrailingWhitespaceFixer::class);

    //There MUST be no trailing spaces inside comment or PHPDoc.
    $services->set(NoTrailingWhitespaceInCommentFixer::class);

    //A PHP file without end tag must always end with a single empty line feed.
    $services->set(SingleBlankLineAtEofFixer::class);

    //There MUST NOT be more than one property or constant declared per statement. https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/rules/class_notation/single_class_element_per_statement.rst
    $services->set(SingleClassElementPerStatementFixer::class);

    //There MUST be one "use" keyword per declaration.
    $services->set(SingleImportPerStatementFixer::class);

    //Each namespace use MUST go on its own line and there MUST be one blank line after the use statements block.
    $services->set(SingleLineAfterImportsFixer::class);

    //A case should be followed by a colon and not a semicolon.
    $services->set(SwitchCaseSemicolonToColonFixer::class);

    //Removes extra spaces between colon and case value.
    $services->set(SwitchCaseSpaceFixer::class);

    //Visibility MUST be declared on all properties and methods; abstract and final MUST be declared before the visibility; static MUST be declared after the visibility.
    $services->set(VisibilityRequiredFixer::class)->call('configure', [[
        'elements' => ['const', 'method', 'property'],
    ]]);

    //clean-code starts here

    // $services->set(ParamReturnAndVarTagMalformsFixer::class);

    //PHP arrays should be declared using the configured syntax. [array(1,2) => [1,2]]
    $services->set(ArraySyntaxFixer::class);

    //Remove useless (semicolon) ";" statements.
    $services->set(NoEmptyStatementFixer::class);

    //Converts protected variables and methods to private where possible.
    $services->set(ProtectedToPrivateFixer::class);

    //Removes unneeded parentheses around control statements.
    $services->set(NoUnneededControlParenthesesFixer::class);

    //Removes unneeded curly "{" braces that are superfluous and aren't part of a control structure's body.
    $services->set(NoUnneededCurlyBracesFixer::class);

    //php8-migration starts here
    // $services->set(BacktickToShellExecFixer::class);
    // $services->set(HeredocIndentationFixer::class);

    //Variables must be set null instead of using (unset) casting. [(unset) $b => null]
    $services->set(NoUnsetCastFixer::class);

    //Array index should always be written by using square braces. [$sample{$index} => $sample[$index]]
    $services->set(NormalizeIndexBraceFixer::class);

    //Use null coalescing operator ?? where possible. Requires PHP >= 7.0. [isset($a) ? $a : $b => $a ?? $b]
    $services->set(TernaryToNullCoalescingFixer::class);

    //psr12 start here

    //Cast should be written in lower case. (BOOLEAN) => (boolean)
    $services->set(LowercaseCastFixer::class);

    //Cast (boolean) and (integer) should be written as (bool) and (int), (double) and (real) as (float), (binary) as (string).
    $services->set(ShortScalarCastFixer::class);

    //Ensure there is no code on the same line as the PHP open tag and it is followed by a blank line.
    $services->set(BlankLineAfterOpeningTagFixer::class);

    //Remove leading (\) slashes in use clauses. [use \Bar; => use Bar;]
    $services->set(NoLeadingImportSlashFixer::class);

    //Equal sign in declare statement should be surrounded by spaces or not following configuration. [test($x=1) => test($x = 1)]
    $services->set(DeclareEqualNormalizeFixer::class)->call('configure', [[
        'space' => 'none',
    ]]);

    //Unary operators should be placed adjacent to their operands. [$i ++; => $i++;]
    $services->set(UnaryOperatorSpacesFixer::class);

    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::SKIP, [
        SingleImportPerStatementFixer::class => null,
        AssignmentInConditionSniff::class . '.FoundInWhileCondition' => null, //common/control-structures.php
    ]);
};
