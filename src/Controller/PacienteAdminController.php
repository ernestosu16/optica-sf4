<?php


namespace App\Controller;


use Sonata\AdminBundle\Controller\CRUDController;

class PacienteAdminController extends CRUDController
{
    public function crearRecetaAction()
    {
        return $this->renderWithExtraParams('::Admin/paciente/receta/form.html.twig', array(
//            'object' => $object,
//            'redirectTo' => $redirectTo,
        ));
    }
}