<?php 

namespace LPDW\TrainspovingBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use LPDW\TrainspovingBundle\Parser\StationParser;

class SNCFSyncCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			->setName('SNCF:sync')
			->setDescription('Synchronize SNCF datas and Trainspoving database');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$kernel = $this->getContainer()->get('kernel');
		$path = $kernel->locateResource('@LPDWTrainspovingBundle/Resources/sncf/coucou.xml');
		$xml = file_get_contents($path);

		$em = $this->getContainer()->get('doctrine.orm.entity_manager');
		//$xml = simplexml_load_file($path);
		$parser = new StationParser;
		$result=$parser->parse($xml, function(){
			echo 'coucou';
			//$em->persist($station);
			//$em->flush();
		}, true);
		
		$output->writeln($result);
	}
}