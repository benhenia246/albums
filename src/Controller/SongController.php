<?php

namespace App\Controller;

use App\Entity\Song;
use App\Entity\Album;
use App\Form\SongType;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/song")
 */
class SongController extends AbstractController
{
    /**
     * @Route("/", name="song_index", methods={"GET"})
     */
    public function index(SongRepository $songRepository): Response
    {
        return $this->render('song/index.html.twig', [
            'songs' => $songRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="song_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $song = new Song();
        $form = $this->createForm(SongType::class, $song);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($song);
            $entityManager->flush();

            return $this->redirectToRoute('song_index');
        }

        return $this->render('song/new.html.twig', [
            'song' => $song,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="song_show", methods={"GET"})
     */
    public function show(Song $song): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
//        $album = $entityManager->getRepository(Album::class)->findOneBy([['song' => $song]]);
        $albums = $entityManager->getRepository(Album::class)->findAll();
//
//        foreach($album as $test){
//            dd($test->getCover());
//        }

//        $entityManager->getRepository(Album::class)->findAll();
//        $entityManager->getRepository(Album::class)->findBy([]);
//        $entityManager->getRepository(Album::class)->findOneBy([]);

        return $this->render('song/show.html.twig', [
            'song' => $song,
            'albums' => $albums,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="song_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Song $song): Response
    {
        $form = $this->createForm(SongType::class, $song);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('song_index');
        }

        return $this->render('song/edit.html.twig', [
            'song' => $song,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="song_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Song $song): Response
    {
        if ($this->isCsrfTokenValid('delete'.$song->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($song);
            $entityManager->flush();
        }

        return $this->redirectToRoute('song_index');
    }
}