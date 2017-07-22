<?php

namespace MyDataLab\Bundle\FrontendBundle\Controller;

use MyDataLab\Bundle\CoreBundle\Entity\Language;
use MyDataLab\Bundle\LeadsBundle\Entity\WhitePaperLead;
use MyDataLab\Bundle\LeadsBundle\Form\LeadType;
use MyDataLab\Bundle\LeadsBundle\Entity\Lead;
use MyDataLab\Bundle\LeadsBundle\Form\WhitePaperLeadType;
use MyDataLab\Bundle\WhitePaperBundle\Entity\DocLink;
use MyDataLab\Bundle\WhitePaperBundle\Entity\WhitePaper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class WhitePaperController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $messages = $session->getFlashBag()->get('white-papers', array());

        $language = $em->getRepository('MyDataLabCoreBundle:Language')->findByCode($request->getLocale());

        $whitePapers = $em->getRepository(WhitePaper::class)->findByLanguage($language);

        return $this->render('MyDataLabFrontendBundle:WhitePapers:index.html.twig', [
            'whitePapers' => $whitePapers,
            'messages' => $messages
        ]);
    }

    /**
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($slug)
    {
        $whitePaper = $this->getDoctrine()->getManager()->getRepository('MyDataLabWhitePaperBundle:WhitePaper')->findOneBy([
            'slug' => $slug,
        ]);

        if (!$whitePaper) {
            throw $this->createNotFoundException('Download not found');
        }

        $submitUrl = $this->generateUrl('my_data_lab_frontend_white_paper_submit_lead', ['id' => $whitePaper->getId()]);
        $signUpForm = $this->generateLeadTypeForm(new WhitePaperLead(), $submitUrl);

        return $this->render('MyDataLabFrontendBundle:WhitePapers:show.html.twig', [
            'whitePaper' => $whitePaper,
            'signUpForm' => $signUpForm->createView()
        ]);
    }

    public function downloadAction($hash)
    {
        $hash = $this->getDoctrine()->getRepository('MyDataLabWhitePaperBundle:DocLink')->findOneBy(['link' => $hash]);
        if($hash->getUsed()){
            throw $this->createNotFoundException('Link not found :(');
        }

        $hash->setUsed(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($hash);
        $em->flush($hash);
        $response = new BinaryFileResponse($this->getWhitePaperFile($hash->getFile()));
        return $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $hash->getFile()->getSlug().'.pdf');
    }

    /**
     * @param WhitePaperLead $lead
     * @param null $url
     * @return \Symfony\Component\Form\Form
     */
    private function generateLeadTypeForm(WhitePaperLead $lead, $url = null)
    {
        $options = array(
            'method' => 'POST',
            'action' => $url
        );

        $signUpForm = $this->createForm(WhitePaperLeadType::class, $lead, $options);
        $signUpForm->add('submit', SubmitType::class, [
            'label' => 'Download Now',
        ]);

        return $signUpForm;
    }

    /**
     * @param WhitePaper $whitePaper
     * @return string The generated URL
     */
    private function generateHash(WhitePaper $whitePaper)
    {
        function generateRandomString($length = 10) {
            return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        }

        $hash = new DocLink();
        $hash->setFile($whitePaper);
        $hash->setLink(generateRandomString());

        $em = $this->getDoctrine()->getManager();
        $em->persist($hash);
        $em->flush();

        return $this->generateUrl('my_data_lab_frontend_white_paper_download', ['hash' => $hash->getLink()], UrlGeneratorInterface::ABSOLUTE_URL);
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function submitLeadAction($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $lead = new WhitePaperLead();
        $whitePaper = $manager->getRepository(WhitePaper::class)->find($id);

        $lead->setLeadSource($whitePaper);
        $lead->setLocale($manager->getRepository(Language::class)->findOneBy(['code' => $request->getLocale()]));

        $signUpForm = $this->generateLeadTypeForm($lead);
        $signUpForm->handleRequest($request);

        if ($signUpForm->isValid()) {
            try {
                $this->saveLead($lead);
                $this->sendMessage($id, $lead);
                $session = $request->getSession();
                $session->getFlashBag()->add('white-papers', $this->get('translator')->trans('PAPER_SENT_EMAIL'));
            }
            catch (\Exception $e) {
                throw $this->createNotFoundException($e->getMessage());
            }
            finally {
                return new RedirectResponse($this->generateUrl('my_data_lab_frontend_white_paper_homepage'));
            }
        }
    }

    /**
     * @param WhitePaper $whitePaper
     * @return string
     */
    private function getWhitePaperFile(WhitePaper $whitePaper)
    {
        return $this->getParameter('whitePaperFilesDirectory').'/'.$whitePaper->getFile();
    }

    /**
     * @param WhitePaperLead $lead
     */
    private function saveLead(WhitePaperLead $lead)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($lead);

        return $manager->flush();
    }

    /**
     * @param $id
     * @param WhitePaperLead $lead
     */
    private function sendMessage($id, WhitePaperLead $lead)
    {
        $manager = $this->getDoctrine()->getManager();

        $whitePaper = $manager->getRepository(WhitePaper::class)->find($id);
        $hashAddress = $this->generateHash($whitePaper);

        $message = \Swift_Message::newInstance()
        ->setSubject($whitePaper->getTitle())
        ->setFrom([
            $this->getParameter('admin_email')
        ])
        ->setTo([
            $lead->getEmail() => $lead->getFirstName().' '.$lead->getLastName()
        ])
        ->setBody(
            $this->renderView('MyDataLabFrontendBundle:Email:white-papers.html.twig', [
                'leadName' => $lead->getFirstName(),
                'paperName' => $whitePaper->getTitle(),
                'hashAddress' => $hashAddress
            ]),
            'text/html'
        )
        ->addPart(
            'Hi '.$lead->getFirstName().
            'Thank you for requesting our resource.
            You can download the file via the link below:
            '.$hashAddress.
            'Best Regards,
            My Data Laboratory Team',
            'text/plain'
        );

        return $this->get('mailer')->send($message);
    }

}