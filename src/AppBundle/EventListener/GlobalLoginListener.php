<?php
namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GlobalLoginListener implements EventSubscriberInterface
{
    private $defaultLocale;
    private $container;

    public function __construct($defaultLocale = 'en', $container)
    {
        $this->defaultLocale = $defaultLocale;
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }
        $userLocale = $this->defaultLocale;
        if ($locale = $request->attributes->get('_locale')) {
            $userLocale = $locale;
        }
        $route = $request->get('_route');
        // var_dump($route);

        // if(!$this->container->isGranted('IS_AUTHENTICATED_FULLY') ){
        if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            if(strpos($route, "fos_user_") === false && 
               strpos($route, "sonata_user_admin_") === false){
                // $response = new RedirectResponse("/".$userLocale."/login");
                // $event->setResponse($response);
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            // must be registered after the default Locale listener
            KernelEvents::REQUEST => array(array('onKernelRequest', 0)),
        );
    }
}