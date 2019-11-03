<?php
# src/AppBundle/Controller/User/PreferenceController.php

namespace AppBundle\Controller\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Form\Type\PreferenceType;
use AppBundle\Entity\Preference;

class PreferenceController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * UserController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @ApiDoc(
     *    description="Les différents prix par places",
     *    output= { "class"=User::class, "collection"=true, "groups"={"preference"} }
     * )
     *
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     *
     * @Rest\View(serializerGroups={"preference"})
     * @Rest\Get("/users/{id}/preferences")
     */
    public function getPreferencesAction(Request $request)
    {
        $user = $this->em->getRepository('UserBundle:User')
                         ->find($request->get('id'));

        if (empty($user)) {
            return $this->userNotFound();
        }

        $preferences = $this->em->getRepository('AppBundle:Preference')
                                ->findByUser($user);

        return $preferences;
    }

     /**
      * @ApiDoc(
      *    description="Les différents prix par places",
      *    output= { "class"=User::class, "collection"=true, "groups"={"preference"} }
      * )
      *
      * @param Request $request
      * @return Preference|\FOS\RestBundle\View\View|\Symfony\Component\Form\FormInterface
      *
      * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"preference"})
      * @Rest\Post("/users/{id}/preferences")
      */
    public function postPreferencesAction(Request $request)
    {
        $user = $this->em->getRepository('UserBundle:User')
                         ->find($request->get('id'));

        if (empty($user)) {
            return $this->userNotFound();
        }

        $preference = new Preference();
        $preference->setUser($user);
        $form = $this->createForm(PreferenceType::class, $preference);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $this->em->persist($preference);
            $this->em->flush();
            return $preference;
        } else {
            return $form;
        }
    }

    private function userNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }
}
