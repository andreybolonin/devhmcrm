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
use AppBundle\Entity\Lead;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Yaml\Dumper;

class DefaultController extends Controller
{

    /**
     * @throws EntityNotFoundException
     *
     * @return RedirectResponse
     *
     * @Route("/phone/{phone}", name="homepage")
     */
    public function indexAction(Request $request)
    {
//        if ($request->getMethod() == 'POST') {

        $array = array(
            'phone' => $request->get('phone'),
            'datetime' => date('Y-m-d H:i:s', time()),
        );

        $dumper = new Dumper();

        $yaml = $dumper->dump($array);

        file_put_contents('/var/www/clients.yml', $yaml);

        return new JsonResponse(true);
//        }
    }
}
