<?php
/**
 * ZF-Hipsters Bootstrap Flash Messenger (https://github.com/zf-hipsters)
 *
 * @link      https://github.com/zf-hipsters/bootstrap-flash-messenger for the canonical source repository
 * @copyright Copyright (c) 2013 ZF-Hipsters
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache Licence, Version 2.0
 */
namespace FlashMessenger\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Class FlashMessenger
 * @package FlashMessenger\Controller\Plugin
 */
class FlashMessenger extends AbstractPlugin
{

    /**
     * Control Plugin
     *
     * @param $message
     * @param string $namespace
     * @return \Zend\Mvc\Controller\Plugin\FlashMessenger
     */
    public function __invoke($message, $namespace = 'success')
    {
        $fm = new \Zend\Mvc\Controller\Plugin\FlashMessenger();
        $fm->setNamespace($namespace);

        if (is_array($message)) {
            foreach ($message as $msg) {
                $fm->addMessage($msg);
            }
        } else {
            $fm->addMessage($message);
        }

        return $fm;
    }
}
