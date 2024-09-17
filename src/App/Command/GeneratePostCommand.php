<?php

namespace App\Command;

use App\Service\PostGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GeneratePostCommand extends Command
{
    protected static $defaultName = 'app:generate-post';
    protected static $defaultDescription = 'Generates a post (random or summary)';

    private EntityManagerInterface $em;
    private PostGenerator $postGenerator;

    public function __construct(EntityManagerInterface $em, PostGenerator $postGenerator, string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
        $this->postGenerator = $postGenerator;
    }


    protected function configure(): void
    {
        $this
            ->addArgument(
                'type',
                InputArgument::OPTIONAL,
                'The type of post to generate (random or summary)',
                'random'
            );
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $type = $input->getArgument('type');

        $post = $this->postGenerator->generateByType($type);

        $this->em->persist($post);
        $this->em->flush();

        $output->writeln($type === 'summary' ? 'A summary post has been generated.' : 'A random post has been generated.');

        return Command::SUCCESS;
    }
}
