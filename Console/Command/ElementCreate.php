<?php

namespace Melios\Dev\Console\Command;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ElementCreate extends Command
{
    protected WriteInterface $directory;

    public function __construct(
        protected Stubs $stubs,
        protected Filesystem $filesystem,
    ) {
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::ROOT);
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('melios:element:create')
            ->setDescription('Create new element')
            ->addArgument('content_type', InputArgument::REQUIRED, 'Content type code')
            ->addOption('path', null, null, 'Path to the module. Relative to Magento root.')
            ->addOption('parent', null, null, 'Element accepts children. Eg. collection.')
            ->addOption('dry-run', null, null, 'Do not generate files');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $basePath = $input->getOption('path') ?: 'vendor/melios/page-builder-pro';

            if ($input->getOption('parent')) {
                $files = $this->stubs->parentElement(
                    $input->getArgument('content_type'),
                    $basePath
                );
            } else {
                $files = $this->stubs->element(
                    $input->getArgument('content_type'),
                    $basePath
                );
            }

            foreach ($files as $path => $values) {
                if ($this->directory->isExist($path)) {
                    throw new \Exception("Failed. File already exists: {$path}");
                }
            }

            foreach ($files as $path => $values) {
                if (!$input->getOption('dry-run')) {
                    $this->directory->writeFile($path, $values['content']);
                }
                $output->writeln("✓ {$path}");
            }

            return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
                $output->writeln($e->getTraceAsString());
            }

            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }
    }
}
