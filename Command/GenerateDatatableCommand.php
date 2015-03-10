<?php

/**
 * This file is part of the T3DatatablesBundle package.
 *
 * (c) stwe <https://github.com/stwe/DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace T3\DatatablesBundle\Command;

use T3\DatatablesBundle\Generator\DatatableGenerator;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCommand;
use Sensio\Bundle\GeneratorBundle\Command\Validators;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use RuntimeException;

/**
 * Class GenerateDatatableCommand
 *
 * @package T3\DatatablesBundle\Command
 */
class GenerateDatatableCommand extends GenerateDoctrineCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName("datatable:generate:class")
            ->setDescription("Generates a datatable class based on a Doctrine entity.")
            ->setDefinition(
                array(
                    new InputArgument("entity", InputArgument::REQUIRED, "The Doctrine entity class name (shortcut notation)."),
                    new InputOption("style", "", InputOption::VALUE_REQUIRED, "The datatable style (base, base-no-classes, base-row-borders,
                        base-cell-borders, base-hover, base-order, base-stripe, jquery-ui, bootstrap, foundation)", "bootstrap"),
                    new InputOption("fields", "", InputOption::VALUE_OPTIONAL, "The fields in the datatable"),
                    new InputOption("client-side", "", InputOption::VALUE_NONE, "The client-side flag"),
                    new InputOption("ajax-url", "", InputOption::VALUE_OPTIONAL, "The ajax url"),
                    new InputOption("filtering", "", InputOption::VALUE_OPTIONAL, "The individual filtering flag"),
                )
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entity = Validators::validateEntityName($input->getArgument("entity"));
        list($bundle, $entity) = $this->parseShortcutNotation($entity);

        $style = $input->getOption("style");
        $fields = Fields::parseFields($input->getOption("fields"));
        $clientSide = $input->getOption("client-side");
        $ajaxUrl = $input->getOption("ajax-url");
        $individualFiltering = $input->getOption("filtering");

        $entityClass = $this->getContainer()->get("doctrine")->getAliasNamespace($bundle) . "\\" . $entity;
        $metadata = $this->getEntityMetadata($entityClass);

        if (count($metadata[0]->identifier) > 1) {
            throw new RuntimeException("The datatable class generator does not support entities with multiple primary keys.");
        }

        if (0 == count($fields)) {
            $fields = $this->getFieldsFromMetadata($metadata[0]);
        }

        $bundle = $this->getApplication()->getKernel()->getBundle($bundle);

        $generator = $this->getGenerator($bundle);
        $generator->generate($bundle, $entity, $style, $fields, $clientSide, $ajaxUrl, $individualFiltering);

        $output->writeln(
            sprintf(
                "The new datatable %s.php class file has been created under %s.",
                $generator->getClassName(),
                $generator->getClassPath()
            )
        );
    }

    /**
     * @return DatatableGenerator
     */
    protected function createGenerator()
    {
        return new DatatableGenerator($this->getContainer()->get("filesystem"));
    }

    /**
     * @param BundleInterface $bundle
     *
     * @return array
     */
    protected function getSkeletonDirs(BundleInterface $bundle = null)
    {
        $skeletonDirs = array();

        if (isset($bundle) && is_dir($dir = $bundle->getPath() . "/Resources/SensioGeneratorBundle/skeleton")) {
            $skeletonDirs[] = $dir;
        }

        if (is_dir($dir = $this->getContainer()->get("kernel")->getRootdir() . "/Resources/SensioGeneratorBundle/skeleton")) {
            $skeletonDirs[] = $dir;
        }

        $reflClass = new \ReflectionClass(get_class($this));
        $skeletonDirs[] = dirname($reflClass->getFileName()) . "/../Resources/views/Skeleton";

        return $skeletonDirs;
    }


    //-------------------------------------------------
    // Private
    //-------------------------------------------------

    /**
     * Returns an array of fields. Fields can be both column fields and
     * association fields.
     *
     * @param ClassMetadataInfo $metadata
     *
     * @return array $fields
     */
    private function getFieldsFromMetadata(ClassMetadataInfo $metadata)
    {
        $fields = array();

        foreach ($metadata->fieldMappings as $field) {
            $row = array();
            $row["property"] = $field["fieldName"];

            switch($field["type"]) {
                case "datetime":
                    $row["column_name"] = "datetime";
                    break;
                case "boolean":
                    $row["column_name"] = "boolean";
                    break;
                default:
                    $row["column_name"] = "column";
            }

            $row["title"] = ucwords($field["fieldName"]);
            $fields[] = $row;
        }

        foreach ($metadata->associationMappings as $relation) {
            if ( ($relation["type"] !== ClassMetadataInfo::ONE_TO_MANY) && ($relation["type"] !== ClassMetadataInfo::MANY_TO_MANY) ) {

                $targetClass = $relation["targetEntity"];
                $targetMetadata = $this->getEntityMetadata($targetClass);

                foreach ($targetMetadata[0]->fieldMappings as $field) {
                    $row = array();
                    $row["property"] = $relation["fieldName"] . "." . $field["fieldName"];
                    $row["column_name"] = "column";
                    $row["title"] = ucwords(str_replace(".", " ", $row["property"]));
                    $fields[] = $row;
                }
            }
        }

        return $fields;
    }
}
