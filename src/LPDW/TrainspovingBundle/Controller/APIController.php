<?php

namespace LPDW\TrainspovingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LPDW\TrainspovingBundle\Entity\RFID;
use LPDW\TrainspovingBundle\Form\RFIDType;

/**
 * @Route("/api")
 */
class APIController extends Controller
{
    /**
     * @Route("/rfid", name="rfid_create")
     * @Method("POST")
     */
    public function newRfidAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rfid = $em->find('LPDWTrainspovingBundle:RFID', $request->request->get('id'));
        if (!$rfid) {
            $rfid = new RFID();
        }
        $form = $this->createRFIDForm($rfid);

        $form->bind($request);
        if ($form->isValid()) {
            $em->persist($rfid);
            $em->flush();

            return new Response(null, 201); // HTTP 201 Created
        }

        return new Response(null, 400); // HTTP 400 Bad Request
    }

    private function createRFIDForm($rfid = null)
    {
        return $this->get('form.factory')->createNamed(null, new RFIDType(), $rfid, array(
            'csrf_protection' => false
        ));
    }
}