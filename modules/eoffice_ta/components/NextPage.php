<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 3/2/2561
 * Time: 15:05
 */
namespace app\modules\eoffice_ta\components;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\base\Widget;
use yii\data\Pagination;


class NextPage extends \yii\widgets\LinkPager
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();
    }

    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = ['class' => $class === '' ? null : $class];
        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }
        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);
            return Html::tag('li', Html::tag('span', $label), $options);
        }
        $linkOptions              = $this->linkOptions;
        $linkOptions['data-page'] = $page;
        $linkOptions['onclick']   = 'submit_form(' . $page . ')';

        return Html::tag('li', Html::a($label, '#pagination', $linkOptions), $options);
    }
}
?>


