<?php

/*
 * This file is part of the PHP CS utility.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfony\CS\Fixer\Contrib;

use Symfony\CS\AbstractFixer;
use Symfony\CS\Tokenizer\Tokens;

/**
 * @author Jared Henderson <jared@netrivet.com>
 */
class TrimArraySpacesFixer extends AbstractFixer
{
    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'Single line arrays should be formatted like function/method arguments, without leading or trailing space.';
    }

    /**
     * {@inheritdoc}
     */
    public function fix(\SplFileInfo $file, $content)
    {
        $tokens = Tokens::fromCode($content);

        for ($index = 0, $c = $tokens->count(); $index < $c; ++$index) {
            if ($tokens->isArray($index)) {
                $this->fixArray($tokens, $index);
            }
        }

        return $tokens->generateCode();
    }

    /**
     * Method to trim leading/trailing whitespace within single line arrays.
     *
     * @param Tokens $tokens
     * @param int    $index
     */
    private function fixArray(Tokens $tokens, $index)
    {
        if ($tokens->isArrayMultiLine($index)) {
            return;
        }

        $startIndex = $index;

        if ($tokens[$startIndex]->isGivenKind(T_ARRAY)) {
            $startIndex = $tokens->getNextTokenOfKind($startIndex, array('('));
            $endIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $startIndex);
        } else {
            $endIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_SQUARE_BRACE, $startIndex);
        }

        if ($tokens[$startIndex + 1]->isWhitespace()) {
            $tokens[$startIndex + 1]->clear();
        }

        if ($tokens[$endIndex - 1]->isWhitespace()) {
            $tokens[$endIndex - 1]->clear();
        }
    }
}
