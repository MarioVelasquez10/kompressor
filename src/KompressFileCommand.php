<?php 
namespace Mev;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class KompressFileCommand extends Command
{
	public function configure()
	{
		$this->setName('KompressFile')
			->setDescription('Compress a file to a tar.gz format')
			->addArgument('name', InputArgument::REQUIRED, 'Name of the file to compress');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
			$file = $input->getArgument('name');
			$message = 'Successfully Compressed, ' . $file;
			$kompress = new Process('tar -cvzf ' . $file. '.tar.gz '. $file);
			$kompress->run();
			if (!$kompress->isSuccessful()) {
			    throw new ProcessFailedException($kompress);
			}
			echo $kompress->getOutput();
		    $output->writeln("<info>{$message}</info>");
	}
}
