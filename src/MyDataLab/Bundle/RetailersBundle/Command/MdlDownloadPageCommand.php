<?php

namespace MyDataLab\Bundle\RetailersBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @deprecated
 */
class MdlDownloadPageCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
                ->setName('mdl:download-page')
                ->setDescription('...')
                ->addArgument('retailerId', InputArgument::REQUIRED, 'Retailer id')
//            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    private function get($id)
    {
        return $this->getContainer()->get($id);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $retailerId = $input->getArgument('retailerId');
        $retailer = $this->getContainer()->get('doctrine')->getRepository('MyDataLabRetailersBundle:Retailer')->find($retailerId);
        $productPage = $retailer->getProductPage();

        $dir = \implode(DIRECTORY_SEPARATOR, [
            $this->getContainer()->getParameter('kernel.root_dir'),
            '..',
            'web',
            'retailers',
            $retailerId,
        ]);
        if (!file_exists($dir)) {
            \mkdir($dir);
        }
        \chdir($dir);
//        $command = 'wget --recursive --no-clobber --page-requisites --html-extension --convert-links --restrict-file-names=windows --domains website.org --no-parent '
//                . $productPage;
//        \exec($command);
        $path = $dir . DIRECTORY_SEPARATOR . str_replace('?', 'index.html@', preg_replace('/https?:\/\//', '', $productPage)) . '.html';
        echo PHP_EOL . $path . PHP_EOL;exit;
        $fh = \fopen($path, 'a');
        \fputs($fh, '');
        \fclose($fh);
        $output->writeln('Success maybe...');
    }

}
