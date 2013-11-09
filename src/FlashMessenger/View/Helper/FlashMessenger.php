<?php
/**
 * ZF-Hipsters Bootstrap Flash Messenger (https://github.com/zf-hipsters)
 *
 * @link      https://github.com/zf-hipsters/bootstrap-flash-messenger for the canonical source repository
 * @copyright Copyright (c) 2013 ZF-Hipsters
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache Licence, Version 2.0
 */

namespace FlashMessenger\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;

/**
 * Class FlashMessenger
 * @package FlashMessenger\View\Helper
 */
class FlashMessenger extends AbstractHelper implements ServiceLocatorAwareInterface
{
    /**
     * @var null
     */
    protected $renderer = null;

    /**
     * Default namespaces
     * @var array
     */
    protected $namespaces = array(
        'success',
        'error',
        'info',
        'warning'
    );

    /**
     * Flash Messenger View Helper
     * @return string
     */
    public function __invoke()
    {

        $flashMessenger = new \Zend\Mvc\Controller\Plugin\FlashMessenger;
        $messageString = '';

        foreach ( $this->namespaces as $ns ) {

            $flashMessenger->setNamespace( $ns );
            $messages = array_merge(
                $flashMessenger->getMessages(),
                $flashMessenger->getCurrentMessages()
            );

            if (empty($messages)) {
                continue;
            }

            $viewModel = new ViewModel(array(
                'namespace' => $ns,
                'messages' => implode( '<br />', $messages )
            ));

            $viewModel->setTemplate('flash-messenger/' . $ns);

            $messageString .= $this->getRenderer()->render($viewModel);
        }

        return $messageString ;
    }

    /**
     * Return the PHP Renderer to render the partials
     * @return null|PhpRenderer
     */
    protected function getRenderer()
    {
        if (is_null($this->renderer)) {
            $renderer = new PhpRenderer();
            $resolver = new AggregateResolver();
            $stack = new TemplatePathStack();

            $config = $this->getServiceLocator()->get('Config');

            foreach($config['view_manager']["template_path_stack"] as $path) {
                $stack->addPath($path);
            }

            $resolver->attach($stack);
            $renderer->setResolver($resolver);

            $this->renderer = $renderer;
        }

        return $this->renderer;
    }

    /**
     * Set serviceManager instance
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return void
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Retrieve serviceManager instance
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        $sm = $this->serviceLocator->getServiceLocator();
        return $sm;

    }
}