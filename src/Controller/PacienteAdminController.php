<?php


namespace App\Controller;


use Sonata\AdminBundle\Controller\CRUDController;

class PacienteAdminController extends CRUDController
{
    public function crearRecetaAction($id)
    {
        return $this->redirectToRoute('admin_app_appreceta_crear_receta_paciente',['id'=>$id]);
//        $object = new AppReceta();
//        $formCreator = new FormContractor(Forms::createFormFactory());
//
//        $formBuilder = $this->createFormBuilder($object);
//        $this->admin->setSubject($object);
//
//        $form = new FormMapper($formCreator, $formBuilder, $this->admin);
//        $form
//            ->with('Receta', ['class' => 'col-md-8'])
//            # Datos general de la receta
//            ->add('numero', null, [
//                'disabled' => $object->getId(),
//            ])
//            ->add('fecha', DateTimePickerType::class, [
//                'disabled' => $object->getId(),
//                'required' => false,
//                'label' => 'Fecha de Refracción'
//            ])
//            ->add('dp', null, [
//                'disabled' => $object->getId(),
//                'label' => 'DP'
//            ])
//            ->add('add', null, [
//                'disabled' => $object->getId(),
//            ])
//            # Ojo derecho//
//            ->add('cristal_od', null, array(
//                'disabled' => $object->getId(),
//                'label' => 'Cristal'
//            ))
//            ->add('eje_od', null, array(
//                'disabled' => $object->getId(),
//                'label' => 'Eje'
//            ))
//            ->add('a_visual_od', null, array(
//                'disabled' => $object->getId(),
//                'label' => 'Agudeza Visual'
//            ))
//            # Ojo izquierdo
//            ->add('cristal_oi', null, array(
//                'disabled' => $object->getId(),
//                'label' => 'Cristal'
//            ))
//            ->add('eje_oi', null, array(
//                'disabled' => $object->getId(),
//                'label' => 'Eje'
//            ))
//            ->add('a_visual_oi', null, array(
//                'disabled' => $object->getId(),
//                'label' => 'Agudeza Visual'
//            ))
//            ->add('receta_trabajador')
//            ->add('receta_lugar')
//            ->end()
//        ;
//
//        return $this->renderWithExtraParams('::Admin/paciente/receta/form.html.twig', array(
//            'object' => $object,
//            'form' => $form->getFormBuilder()->getForm()->createView(),
////            'redirectTo' => $redirectTo,
//        ));
    }
}