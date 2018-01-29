<?php

namespace XframeCMS\Exception\Observer;

use SplObserver;
use SplSubject;
use Xframe\Core\DependencyInjectionContainer;
use Xframe\View\TwigView;

/**
 * Uses the observer pattern to listen for exceptions.
 *
 * This code was largely inspired by the devzone article:
 *
 * http://devzone.zend.com/article/12229
 *
 * @package errors_observers
 */
class ExceptionWebView implements SplObserver
{
    /**
     * @var DependencyInjectionContainer
     */
    private $dic;

    /**
     * Initialise the observer.
     */
    public function __construct(DependencyInjectionContainer $dic)
    {
        $this->dic = $dic;
    }

    /**
     * Log the exception.
     *
     * @param SplSubject $subject
     */
    public function update(SplSubject $subject)
    {
        $view = new TwigView(
            $this->dic->registry,
            $this->dic->root,
            $this->dic->tmp,
            'error',
            $this->dic->isDev
        );

        $view->isLive = $this->dic->isLive;
        $view->__set('template', 'error');
        $view->errorMessage = $subject->getLastException()->getMessage();
        $view->errorStack = $this->dic->isLive ? '' : $subject->getLastException()->getTraceAsString();

        echo $view->execute();
    }
}
