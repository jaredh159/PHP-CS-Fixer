<?php

/*
 * This file is part of the PHP CS utility.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfony\CS\Tests\Fixer\Contrib;

use Symfony\CS\Tests\Fixer\AbstractFixerTestBase;

/**
 * @author Jared Henderson <jared@netrivet.com>
 */
class TrimArraySpacesFixerTest extends AbstractFixerTestBase
{
    /**
     * @dataProvider provideFixCases
     */
    public function testFix($expected, $input = null)
    {
        $this->makeTest($expected, $input);
    }

    public function provideFixCases()
    {
        return array(

            array(
                "<?php \$foo = array('foo');",
                "<?php \$foo = array( 'foo' );",
            ),

            array(
                "<?php \$foo = ['foo'];",
                "<?php \$foo = [ 'foo' ];",
            ),

            array(
                "<?php \$foo = array();",
                "<?php \$foo = array( );",
            ),

            array(
                "<?php \$foo = [];",
                "<?php \$foo = [ ];",
            ),

            array(
                "<?php \$foo = array('foo', 'bar');",
                "<?php \$foo = array( 'foo', 'bar' );",
            ),

            array(
                "<?php \$foo = ['foo', 'bar'];",
                "<?php \$foo = [ 'foo', 'bar' ];",
            ),

            array(
                "<?php \$foo = array('foo', 'bar'); \$bar = array('foo', 'bar');",
                "<?php \$foo = array( 'foo', 'bar' ); \$bar = array( 'foo', 'bar' );",
            ),

            array(
                "<?php \$foo = ['foo', 'bar']; \$bar = ['foo', 'bar'];",
                "<?php \$foo = [ 'foo', 'bar' ]; \$bar = [ 'foo', 'bar' ];",
            ),

            array(
                "<?php \$foo = array('foo' => 'bar');",
                "<?php \$foo = array( 'foo' => 'bar' );",
            ),

            array(
                "<?php \$foo = ['foo' => 'bar'];",
                "<?php \$foo = [ 'foo' => 'bar' ];",
            ),

            array(
                "<?php \$foo = array('foo');",
                "<?php \$foo = array( 'foo' );",
            ),

            array(
                "<?php \$foo = ['foo'];",
                "<?php \$foo = [ 'foo' ];",
            ),

            array(
                "<?php \$foo = array(\$y ? true : false);",
                "<?php \$foo = array( \$y ? true : false );",
            ),

            array(
                "<?php \$foo = [\$y ? true : false];",
                "<?php \$foo = [ \$y ? true : false ];",
            ),

            array(
                "<?php \$foo = array(array('foo'), array('bar'));",
                "<?php \$foo = array( array( 'foo' ), array( 'bar' ) );",
            ),

            array(
                "<?php \$foo = [['foo'], ['bar']];",
                "<?php \$foo = [ [ 'foo' ], [ 'bar' ] ];",
            ),

            array(
                "<?php function(array \$foo = array('bar')) {}",
                "<?php function(array \$foo = array( 'bar' )) {}",
            ),

            array(
                "<?php function(array \$foo = ['bar']) {}",
                "<?php function(array \$foo = [ 'bar' ]) {}",
            ),

            array(
                "<?php \$foo = array(function() {return 'foo';});",
                "<?php \$foo = array( function() {return 'foo';} );",
            ),

            array(
                "<?php \$foo = [function() {return 'foo';}];",
                "<?php \$foo = [ function() {return 'foo';} ];",
            ),

            array(
                "<?php \$foo = array(\$bar->method(), Foo::doSomething());",
                "<?php \$foo = array( \$bar->method(), Foo::doSomething() );",
            ),

            array(
                "<?php \$foo = [\$bar->method(), Foo::doSomething()];",
                "<?php \$foo = [ \$bar->method(), Foo::doSomething() ];",
            ),

            array(
                "<?php \$foo = array(array('foo'), array('bar'));",
                "<?php \$foo = array( array('foo'), array('bar') );",
            ),

            array(
                "<?php \$foo = [['foo'], ['bar']];",
                "<?php \$foo = [ ['foo'], ['bar'] ];",
            ),

            array(
                "<?php \$foo = array(array('foo'), array('bar'));",
                "<?php \$foo = array(array( 'foo' ), array( 'bar' ));",
            ),

            array(
                "<?php \$foo = [['foo'], ['bar']];",
                "<?php \$foo = [[ 'foo' ], [ 'bar' ]];",
            ),

            array(
                "<?php \$foo = array(array('foo'), array('bar'));",
                "<?php \$foo = array( array( 'foo' ), array( 'bar' ) );",
            ),

            array(
                "<?php \$foo = [['foo'], ['bar']];",
                "<?php \$foo = [ [ 'foo' ], [ 'bar' ] ];",
            ),

            array(
                "<?php \$foo = array(array('foo'), array('bar'));",
            ),

            array(
                "<?php \$foo = [['foo'], ['bar']];",
            ),

            array(
                "<?php \$foo = array(/* empty array */);",
                "<?php \$foo = array( /* empty array */ );",
            ),

            array(
                "<?php \$foo = [/* empty array */];",
                "<?php \$foo = [ /* empty array */ ];",
            ),

            array(
                "<?php someFunc(array(/* empty array */));",
                "<?php someFunc(array( /* empty array */ ));",
            ),

            array(
                "<?php someFunc([/* empty array */]);",
                "<?php someFunc([ /* empty array */ ]);",
            ),

            array(
                '<?php $foo = array($bar[  4 ]);',
                '<?php $foo = array( $bar[  4 ] );',
            ),

            array(
                '<?php $foo = [$bar[  4 ]];',
                '<?php $foo = [ $bar[  4 ] ];',
            ),
        );
    }
}
