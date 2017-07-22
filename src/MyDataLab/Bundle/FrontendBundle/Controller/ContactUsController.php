<?php

namespace MyDataLab\Bundle\FrontendBundle\Controller;

use MyDataLab\Bundle\CoreBundle\Entity\Language;
use MyDataLab\Bundle\LeadsBundle\Entity\ContactUsLead;
use MyDataLab\Bundle\LeadsBundle\Form\ContactUsLeadType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactUsController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $messages = $session->getFlashBag()->get('white-papers', array());

        $url = $this->generateUrl('my_data_lab_frontend_contact_us_submit');
        $contactUsLead = new ContactUsLead();
        $sendMessageForm = $this->generateContactUsForm($contactUsLead, $url);

        return $this->render('MyDataLabFrontendBundle:Default:contact-us.html.twig', [
            'sendMessageForm' => $sendMessageForm->createView(),
            'messages' => $messages
        ]);
    }

    /**
     * @param ContactUsLead $lead
     * @param null $url
     * @return \Symfony\Component\Form\Form
     */
    private function generateContactUsForm(ContactUsLead $lead, $url = null)
    {
        $options = array(
            'method' => 'POST',
            'action' => $url
        );

        $sendMessageForm = $this->createForm(ContactUsLeadType::class, $lead, $options);
        $sendMessageForm->add('submit', SubmitType::class, [
            'label' => 'Send Message',
        ]);

        return $sendMessageForm;
    }

    public function submitAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $lead = new ContactUsLead();

        $lead->setLocale($manager->getRepository(Language::class)->findOneBy(['code' => $request->getLocale()]));

        $sendMessageForm = $this->generateContactUsForm($lead);
        $sendMessageForm->handleRequest($request);

        if ($sendMessageForm->isValid()) {
            try {
                $this->saveLead($lead);
                $this->sendMessage($lead);
                $session = $request->getSession();
                $session->getFlashBag()->add('contact-us', $this->get('translator')->trans('CONTACT_CREATED_EMAIL'));
            }
            catch (\Exception $e) {
                throw $this->createNotFoundException($e->getMessage());
            }
            finally {
                return new RedirectResponse($this->generateUrl('my_data_lab_frontend_contact_us'));
            }
        }
    }

    private function saveLead(ContactUsLead $lead)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($lead);

        return $manager->flush();
    }

    private function sendMessage(ContactUsLead $lead)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($lead->getFirstName().' '.$lead->getLastName().' filed a message!')
            ->setFrom([$lead->getEmail()])
            ->setTo([$this->getParameter('admin_contact')])
            ->setBody(
                $lead->getContent(),
                'text/plain'
            )
          ;

        return $this->get('mailer')->send($message);
    }
}