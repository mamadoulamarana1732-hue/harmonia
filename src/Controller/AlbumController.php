<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\SonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        //    $sons = $sonRepository->findBy(['album' => $album]); // à revoir par jule le matin

            return $this->render('item/index.html.twig', [
                'album' => $album,
                // 'son'  => $sons,   // A revoir apr jule demain
            ]);
        }
}
