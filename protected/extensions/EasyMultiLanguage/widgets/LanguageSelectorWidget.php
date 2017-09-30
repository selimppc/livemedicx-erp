<?php
/**
 * LanguageSelectorWidget 
 * 
 * @version 1.0
 * @author vi mark <webvimark@gmail.com> 
 * @license MIT
 *
 * @stolen from http://www.yiiframework.com/wiki/294/seo-conform-multilingual-urls-language-selector-widget-i18n/ 
 * @modified by me
 */
class LanguageSelectorWidget extends CWidget
{
        /**
         * style 
         *
         * "dropDown" or "inline"
         * 
         * @var string
         */
        public $style = 'dropDown';

        /**
         * cssClass 
         *
         * Additional css class for selector
         * 
         * @var string
         */
        public $cssClass = '';


        /**
         * init 
         */
        public function init()
        {
                $languages = Yii::app()->params['languages'];

                if (count($languages) > 1) 
                {
                        $this->render($this->style, array(
                                'languages' => $languages,
                                'cssClass'  => $this->cssClass,
                        ));
                }
        }
}
