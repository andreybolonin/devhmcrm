<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use EasymedBundle\Entity\Lead;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{

    /**
     * @throws EntityNotFoundException
     *
     * @return RedirectResponse
     *
     * @Route("/phone/{phone}", name="homepage")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $form = $request->request->all();

            $lead = new Lead();
            if ($request->get('phone')) {

                $lead->setLastName($request->get('name', 'healthyfood'));
                $lead->setEmail($request->get('email', 'info@healthmarketing.me'));
                $lead->setMobilePhone($request->get('phone'));

                $user = $this->getDoctrine()
                    ->getRepository('ApplicationSonataUserBundle:User')
                    ->find(7);

                if ($user) {
                    $lead->setUser($user);
                } else {
                    throw new EntityNotFoundException();
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($lead);
                $em->flush();

                return new JsonResponse(true);
            }
        }
    }
}
