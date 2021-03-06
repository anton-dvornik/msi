<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Framework\TestFramework\Unit\Matcher;

/**
 * Class MethodInvokedAtIndex
 * Matches invocations per 'method' at 'position'
 * Example:
 * $mock->expects(new MethodInvokedAtIndex(0))->method('getMethod')->willReturn(1);
 * $mock->expects(new MethodInvokedAtIndex(1))->method('getMethod')->willReturn(2);
 *
 * $mock->getMethod(); // returns 1
 * $mock->getMethod(); // returns 2
 *
 * @package Magento\TestFramework\Matcher
 */
class MethodInvokedAtIndex extends \PHPUnit_Framework_MockObject_Matcher_InvokedAtIndex
{
    /**
     * @var array
     */
    protected $indexes = [];

    /**
     * @param  \PHPUnit_Framework_MockObject_Invocation $invocation
     * @return boolean
     */
    public function matches(\PHPUnit_Framework_MockObject_Invocation $invocation)
    {
        /** @noinspection PhpUndefinedFieldInspection */
        if (!isset($this->indexes[$invocation->methodName])) {
            /** @noinspection PhpUndefinedFieldInspection */
            $this->indexes[$invocation->methodName] = 0;
        } else {
            /** @noinspection PhpUndefinedFieldInspection */
            $this->indexes[$invocation->methodName]++;
        }
        $this->currentIndex++;

        /** @noinspection PhpUndefinedFieldInspection */
        return $this->indexes[$invocation->methodName] == $this->sequenceIndex;
    }
}
