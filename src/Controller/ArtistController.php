<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'app_artist')]
    public function index(ArtistRepository $artistrepository): Response
    {
        $artistesEntities = $artistrepository->findAll();
        return $this->render('artist/index.html.twig', [
           'artistesEntities'=>$artistesEntities,
        ]);
    }

    #[Route('/artist-create', name: 'app_artist_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
            $artist = new Artist();
            $form=$this->createForm(ArtistType::class, $artist);

             $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $artist->setCreatedAt(new \DateTimeImmutable());
                $entityManager->persist($artist);
                $entityManager->flush();

              return $this->redirectToRoute('app_artist');

            }

        return $this->render('artist/add.html.twig', [
            'form'=>$form->createview(),
        ]);
    }

        #[Route('/artist-edit/{id}', name: 'app_artist_edit')]
        public function edit(Artist $artist, EntityManagerInterface $entityManager, Request $request): Response
        {
            $form = $this->createForm(ArtistType::class, $artist);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();

                return $this->redirectToRoute('app_artist');
            }

            return $this->render('artist/edit.html.twig', [
                'form' => $form->createView(),
            ]);
        }



}
