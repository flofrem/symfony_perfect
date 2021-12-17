<?php

namespace App\Controller\Front;

use App\Repository\CommandRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandController extends AbstractController
{
    /**
     * @Route("/front/commands/", name="front_list_command")
     */
    public function listCommand(CommandRepository $commandRepository)
    {
        $commands = $commandRepository->findAll();

        return $this->render("front/commands.html.twig", ['commands' => $commands]);
    }

    /**
     * @Route("front/command/{id}", name="front_show_command")
     */
    public function showCommand(CommandRepository $commandRepository, $id)
    {
        $command = $commandRepository->find($id);

        return $this->render("front/command.html.twig", ['command' => $command]);
    }
}
