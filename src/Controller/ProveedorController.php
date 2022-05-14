<?php

namespace App\Controller;

use App\Entity\Proveedor;
use App\Form\ProveedorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProveedorController extends AbstractController
{
//    /**
//     * Test to generate a datatable
//     * @Route("/", name="default")
//     */
//    public function index()
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $data['recordsTotal'] = $entityManager
//            ->createQuery('SELECT count(sd) FROM App:Proveedor sd')
//            ->getSingleScalarResult();
//
//        return $this->render('proveedor/index.html.twig', [
//            'data' => $data,
//        ]);
//    }

    /**
     * Function to charge all datas of proovedors and show in a table
     * @Route("/table", name="table")
     * @return Response
     */
    public function show()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $proveedor = $entityManager->getRepository(Proveedor::class)->findAll();


        return $this->render('proveedor/table.html.twig',
            array('findAll'=>$proveedor)

        );
    }


    /**
     * Funtion to do a form and generate a new Proveedor
     * @Route("/table/new", name="new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function newForm(Request $request)
    {
        $provedor = new Proveedor();

        $form = $this->createForm(ProveedorType::class, $provedor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $provedor = $form->getData();

            $provedor->setCreatedAt(new \DateTime());
            $provedor->setUpdatedAt(new \DateTime());
            $em->persist($provedor);
            $em->flush();

            return $this->redirectToRoute('table');
        }

        return $this->render('proveedor/new.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'Form'


        ]);
    }

    /**
     *  Function to modify a proveedor
     * @Route("/table/modify/{id}", name="modify")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     */
    public function updateProveedor(Request $request, $id)
    {
        $proveedor = $this->getDoctrine()->getManager()->getRepository(Proveedor::class)->find($id);

        $form = $this->createForm(ProveedorType::class,$proveedor);

        $form-> handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid())
        {
            $entrymanager = $this->getDoctrine()->getManager();
            $entrymanager->flush();

            return $this->redirectToRoute('table');
        }

        return $this->render('proveedor/update.html.twig', ['f' =>$form->createView()]);
    }

    /**
     * Function to remove one proveedor
     * @Route("/table/remove/{id}", name="remove")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeProveedor($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $proveedor = $entityManager->getRepository(Proveedor::class)->find($id);

        $entityManager->remove($proveedor);
        $entityManager->flush();

        return $this->redirectToRoute('table');
    }




//    /**
//     * Testing DataTables implementation
//     * @Route("/server-processing.php", name="server_processing")
//     */
//    public function serverProcessing()
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//
//        /*var_dump($_GET['search']['value']);
//        exit;*/
//
//        $dql = 'SELECT sd FROM App:Proveedor sd';
//        $dqlCountFiltered = 'SELECT count(sd) FROM App:Proveedor sd';
//
//        $sqlFilter = '';
//
//        $items = $entityManager
//            ->createQuery($dql)
//            ->setFirstResult($_GET['start'])
//            ->setMaxResults($_GET['length'])
//            ->getResult();
//
//        $data = [];
//        foreach ($items as $key => $value) {
//            $data[] = [
//                $value->getid(),
//                $value->getNombre(),
//                $value->getcorreo(),
//                $value->gettelefono(),
//                $value->gettipo(),
//                $value->getactivo(),
//            ];
//        }
//
//        $recordsTotal = $entityManager
//            ->createQuery('SELECT count(sd) FROM App:Proveedor sd')
//            ->getSingleScalarResult();
//
//        $recordsFiltered = $entityManager
//            ->createQuery($dqlCountFiltered)
//            ->getSingleScalarResult();
//
//        return $this->json([
//            'draw' => 0,
//            'recordsTotal' => $recordsTotal,
//            'recordsFiltered' => $recordsFiltered,
//            'data' => $data,
//            'dql' => $dql,
//            'dqlCountFiltered' => $dqlCountFiltered,
//        ]);
//    }

}
