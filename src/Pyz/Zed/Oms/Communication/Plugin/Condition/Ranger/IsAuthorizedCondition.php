<?php

namespace Pyz\Zed\Oms\Communication\Plugin\Condition\Ranger;

use Generated\Shared\Transfer\StateMachineItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Condition\AbstractCondition;
use Spryker\Zed\StateMachine\Business\Logger\TransitionLogInterface;
use Spryker\Zed\StateMachine\Business\Process\StateInterface;
use Spryker\Zed\StateMachine\Business\StateMachine\ConditionInterface;

class IsAuthorizedCondition extends AbstractCondition implements ConditionInterface
{

    public function check(SpySalesOrderItem $orderItem)
    {
        return true;
    }

    public function getTargetStatesFromTransitions(array $transitions, StateMachineItemTransfer $stateMachineItemTransfer, StateInterface $sourceState, TransitionLogInterface $transactionLogger)
    {
        // TODO: Implement getTargetStatesFromTransitions() method.
    }

    public function getOnEnterEventsForStatesWithoutTransition($stateMachineName, $processName)
    {
        // TODO: Implement getOnEnterEventsForStatesWithoutTransition() method.
    }
}
