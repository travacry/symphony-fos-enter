<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Groups;
use AppBundle\Entity\User;
use AppBundle\Form\DataFormType;
use AppBundle\Repository\DataRepository;
use AppBundle\Request\CreateDataRequest;
use AppBundle\Services\DataService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class DefaultController extends AbstractController
{
    /**
     * @Route("/update", name="update")
     * @Security("has_role('ROLE_USER')")
     * @Template
     */
    public function updateAction(Request $request) {

    }

    /**
     * @Route("/index", name="index")
     * @Security("has_role('ROLE_USER')")
     * @Template
     */
    public function indexAction(Request $request) {

//        $form = '';
//        $createDataRequest = new CreateDataRequest();

        $id = $request->query->get('id');

//        $entityManager = $this->getDoctrine()->getManager();
//        $user = $entityManager->find(User::class, $id);
//        $groups = $user->getGroups();
//        $dataRepository = new DataRepository($entityManager);
//        $dataRepository->load($id);


        $dataService = $this->container->get(DataService::class);


die;

        $dataRepository = $dataService->load($id);

        $form = $this->createForm(DataFormType::class, $dataRepository);


        return [ 'form' => $form->createView() ];
    }



    /**
     * @Route("/create", name="create")
     * @Security("has_role('ROLE_USER')")
     * @Template
     */
    public function createAction(Request $request)
    {
        $createDataRequest = new CreateDataRequest();

        $form = $this->createForm(DataFormType::class, $createDataRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

//            $article = $this->articleFacade->createArticle(
//                $createArticleRequest->title,
//                $createArticleRequest->content,
//                $createArticleRequest->publishDate
//            );

            $entityManager = $this->getDoctrine()->getManager();

            $encoder = new BCryptPasswordEncoder(17);

            $user = new User();

            $user->setUsername($createDataRequest->username);
            $user->setPassword($encoder->encodePassword('asd123', false));
            $user->setEmail($createDataRequest->email);
            $user->setEnabled(true);

            $entityManager->persist($user);

            $groups = new Groups();

            $groups->setUser($user->getId());
            $groups->setName($createDataRequest->groupName);
            $groups->setDate($createDataRequest->date);
            $groups->setDesc($createDataRequest->groupDesc);

            $entityManager->persist($groups);

            $entityManager->flush();
        }

        return $this->redirectToRoute('index');
//        $id = $request->query->get('id');
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $user = $entityManager->find(User::class, $id);
//        $groups = $user->getGroups();
//
//        $list = [];
//
//        foreach ($groups as $group) {
//
//            $data = new CreateDataRequest();
//
//            $data->setUsername($user->getUsername());
//            $data->setEmail($user->getEmail());
//            $data->setGroupName($group->getName());
//            $data->setDate($group->getDate());
//            $data->setGroupDesc($group->getDesc());
//
//            $list[] = $data;
//        }

//        var_dump($request->cookies->all());
//        $dataRequest = new CreateDataRequest();
//        $form = $this->createForm();


//        $form = $this->createFormBuilder($list)
//            ->add('array', Entity::class, [
//            $this->createFormBuilder($data)
//                ->add('username', TextType::class)
//                ->add('email', TextType::class)
//                ->add('date', DateType::class)
//                ->add('groupName', TextType::class)
//                ->add('groupDesc', TextType::class)
//            ])
//            ->add('save', SubmitType::class, array('label' => 'Run save'))
//            ->getForm();


//        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {

//            $data = $form->getData();
//            $entityManager = $this->getDoctrine()->getManager();
//
//
//            new Groups();
//
//            $entityManager->persist($task);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('task_success');
//        }

//        return [ 'form' => $form->createView() ];
    }

    /**
     * @Route("/admin")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
