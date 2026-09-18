<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\SonRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AlbumType;
use App\Entity\Album;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AlbumController extends AbstractController
{
    #[Route('/album', name: 'app_album')]
    public function index(AlbumRepository $albumRepository): Response
    {
        $eptype = $albumRepository->findBy(['type' => 'EP']);
        $singletype = $albumRepository->findBy(['type' => 'SINGLE']);
        $albumtype = $albumRepository->findBy(['type' => 'ALBUM']);
        return $this->render('album/index.html.twig', [
            'eptype' =>$eptype,
           'singletype' => $singletype,
           'albumtype' => $albumtype,
        ]);
    }

        #[Route('/item/{id}', name: 'app_item')]
        public function item($id, AlbumRepository $albumRepository, SonRepository $sonRepository): Response
        {
            $album = $albumRepository->find($id);
           
            if ($album === null) {
                return $this->redirectToRoute('app_home');
            }


            return $this->render('item/index.html.twig', [
                'album' => $album,
               // A revoir apr jule demain
            ]);
        }

        #[Route('/album-create/{id}', name: 'app_album_create')]
        public function create($id, EntityManagerInterface $entityManager, Request $request,ArtistRepository $artistRepository ): Response
        {   $artist = $artistRepository->find($id);
            //dump($artist);
            $album = new Album();
            $album->setArtist($artist);
            $form = $this->createForm(AlbumType::class, $album);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $imageFile = $form->get('imageFile')->getData();

                if ($imageFile) {
                    $newFilename = uniqid().'.'.$imageFile->guessExtension();
                    $imageFile->move($this->getParameter('albums_images_directory'), $newFilename);
                    $album->setImagePath('uploads/'.$newFilename);
                }

                $album->setCreatedAt(new \DateTimeImmutable());
                $entityManager->persist($album);
                $entityManager->flush();

                return $this->redirectToRoute('app_album');
            }

            return $this->render('album/add.html.twig', [
                'form' => $form->createview(),
            ]);
        }


        
}
