<?php
namespace PhpTranspiler\Command;

use PhpTranspiler\Framework\SourceDir;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnalyzeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('analyze')
            ->setDescription('Analyze code')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'What directory or script do you want to work on?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>PHP Transpiler</info>');
        $path = $input->getArgument('path');
        $output->writeln('<info>Analyzing ' . $path . '</info>');
        $source_dir = new SourceDir($path);
        if ($source_dir->path_exists() === false) {
            throw new InvalidArgumentException('Given path does not exist.');
        }
    }
}
