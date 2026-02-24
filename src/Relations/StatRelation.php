<?php
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 */

namespace Yii1x\ActiveRecord\Relations;

use Yii1x\ActiveRecord\Db\Schema\DbCriteria;

class StatRelation extends BaseActiveRelation
{
    /**
     * @var string|array the statistical expression. Defaults to 'COUNT(*)', meaning
     * the count of child objects.
     */
    public string|array $select = 'COUNT(*)';
    /**
     * @var mixed the default value to be assigned to those records that do not
     * receive a statistical query result. Defaults to 0.
     */
    public mixed $defaultValue = 0;
    /**
     * @var mixed scopes to apply
     * Can be set to the one of the following:
     * <ul>
     * <li>Single scope: 'scopes'=>'scopeName'.</li>
     * <li>Multiple scopes: 'scopes'=>array('scopeName1','scopeName2').</li>
     * </ul>
     * @since 1.1.16
     */
    public string|array $scopes = [];

    /**
     * Merges this relation with a criteria specified dynamically.
     * @param array $criteria the dynamically specified criteria
     * @param boolean $fromScope whether the criteria to be merged is from scopes
     */
    public function mergeWith($criteria, $fromScope = false)
    {
        if ($criteria instanceof DbCriteria)
            $criteria = $criteria->toArray();
        parent::mergeWith($criteria, $fromScope);

        if (isset($criteria['defaultValue']))
            $this->defaultValue = $criteria['defaultValue'];
    }
}
