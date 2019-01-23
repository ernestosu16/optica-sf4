<?php

namespace App\Controller;

use App\Entity\SecurityUser;
use App\Filter\SecurityUserFilterType;
use App\Form\SecurityUserType;
use App\Repository\SecurityUserRepository;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderUpdater;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/security/user")
 */
class SecurityUserController extends AbstractController
{
    /**
     * @Route("/", name="security_user_index", methods={"GET"})
     */
    public function index(Request $request, SecurityUserRepository $securityUserRepository, FilterBuilderUpdater $filterBuilderUpdater): Response
    {
        //$queryBuilder = $this->getDoctrine()->getRepository(SecurityUser::class)
        //    ->createQueryBuilder('e');

        $order_by = $request->query->get('order_by', 'e.id');

        $order_type = $request->query->get('order_type', 'ASC');

        $queryBuilder = $securityUserRepository
            ->createQueryBuilder('e');

        $queryBuilder
            ->leftJoin('e.groups', 'g')
            ->orderBy($order_by, $order_type);

        //filter
        $filters_form = $this->get('form.factory')->create(SecurityUserFilterType::class);

        if ($request->query->has($filters_form->getName())) {
            // manually bind values from the request
            $filters_form->submit($request->query->get($filters_form->getName()));

            // build the query from the given form object
            $filterBuilderUpdater->addFilterConditions($filters_form, $queryBuilder);

            // now look at the DQL =)
            //dump($queryBuilder->getDql());
        }

        // $dql_query = $queryBuilder->getDql();

        // dump( $dql_query);

        // $query = $queryBuilder->getQuery(); // $this->getDoctrine()->getManager()->createQuery($dql_query);

        // $list = $query->getResult();

        // $list =  $securityUserRepository->findAll();

        $adapter = new DoctrineORMAdapter($queryBuilder);

        $pagerfanta = new Pagerfanta($adapter);

        $page = $request->query->get('page', 1);

        $pagerfanta->setAllowOutOfRangePages(true);

        $pagerfanta->setCurrentPage($page);

        $pagerfanta->setMaxPerPage(5);

        return $this->render('security_user/index.html.twig',
            [
                'my_pager' => $pagerfanta,
                'filters_form' => $filters_form->createView(),
                'order_by' => $order_by,
                'order_type' => $order_type,
                'page' => $page,
            ]
        );
    }

    /**
     * @Route("/new", name="security_user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $securityUser = new SecurityUser();
        $form = $this->createForm(SecurityUserType::class, $securityUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($securityUser);
            $entityManager->flush();

            return $this->redirectToRoute('security_user_index');
        }

        return $this->render('security_user/new.html.twig', [
            'security_user' => $securityUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="security_user_show", methods={"GET"})
     */
    public function show(SecurityUser $securityUser): Response
    {
        return $this->render('security_user/show.html.twig', [
            'security_user' => $securityUser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="security_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SecurityUser $securityUser): Response
    {
        $form = $this->createForm(SecurityUserType::class, $securityUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('security_user_index', [
                'id' => $securityUser->getId(),
            ]);
        }

        return $this->render('security_user/edit.html.twig', [
            'security_user' => $securityUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="security_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SecurityUser $securityUser): Response
    {
        if ($this->isCsrfTokenValid('delete' . $securityUser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($securityUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('security_user_index');
    }
}
