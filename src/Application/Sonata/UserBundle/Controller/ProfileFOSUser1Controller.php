<?php

namespace Application\Sonata\UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use MD\eLearningBundle\Entity\ElearningProgress;

use Sonata\UserBundle\Controller\ProfileFOSUser1Controller as SonataProfileController;


class ProfileFOSUser1Controller extends SonataProfileController
{
    public function editProfileAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw $this->createAccessDeniedException('This user does not have access to this section.');
        }

        $form = $this->get('fos_user.profile.form');
        $formHandler = $this->get('fos_user.profile.form.handler');

        $process = $formHandler->process($user);
        if ($process) {
            $this->setFlash('sonata_user_success', 'profile.flash.updated');

            return $this->redirect($this->generateUrl('sonata_user_profile_show'));
        }
        return $this->render('SonataUserBundle:Profile:edit_profile.html.twig', array(
            'form' => $form->createView(),
            'breadcrumb_context' => 'user_profile',
        ));
    }

    public function showAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface)
            throw $this->createAccessDeniedException('This user does not have access to this section.');

        return $this->render('SonataUserBundle:Profile:show.html.twig', array(
            'user' => $user,
        ));
    }
}
