<?php

namespace App\Controller;

use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(PlaylistRepository $playlistRepository): Response
    { 
        return $this->render('profil/index.html.twig', [
        
        ]);
    }


}
