<?php

namespace App\Controller;

use App\Entity\Son;
use App\Form\SonType;
use App\Repository\AlbumRepository;
use App\Repository\SonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SonController extends AbstractController
{
           
    #[Route('/son-create/{albumid}', name: 'app_son_create')]
    public function addSon($albumid, EntityManagerInterface $entityManager, Request $request, AlbumRepository $albumRepository): Response
    {
        $album = $albumRepository->find($albumid);
        $son = new Son();
        $son->setAlbums($album);
        $form = $this->createForm(SonType::class, $son);
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
            $son->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($son);
            $entityManager->flush();

            return $this->redirectToRoute('app_item', ['id'=>$albumid]);
        }
        return $this->render('son/add.html.twig', [
           'formSon' =>$form->createView(), 
        ]);
    }
}
