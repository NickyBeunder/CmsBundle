<?php

namespace Opifer\CmsBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Opifer\CrudBundle\Annotation as Opifer;
use Opifer\ContentBundle\Model\Directory as BaseDirectory;

/**
 * Directory
 *
 * @Gedmo\Tree(type="nested")
 * @JMS\ExclusionPolicy("all")
 *
 * @ORM\Table(name="directory")
 * @ORM\Entity(repositoryClass="Opifer\CmsBundle\Repository\DirectoryRepository")
 */
class Directory extends BaseDirectory
{
    /**
     * @var string
     *
     * @JMS\Expose
     * @ORM\Column(name="name", type="string", length=128)
     * @Assert\NotBlank()
     * @Gedmo\Translatable
     * @Opifer\Form(editable=true)
     */
    protected $name;

    /**
     * @ORM\Column(length=255, unique=true)
     *
     * @Gedmo\Slug(handlers={
     *      @Gedmo\SlugHandler(class="Gedmo\Sluggable\Handler\TreeSlugHandler", options={
     *          @Gedmo\SlugHandlerOption(name="parentRelationField", value="parent"),
     *          @Gedmo\SlugHandlerOption(name="separator", value="/")
     *      })
     * }, fields={"name"}, unique_base="site")
     * @Gedmo\Translatable
     */
   protected $slug;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     */
    protected $site;

    /**
     * @var boolean
     *
     * @ORM\Column(name="searchable", type="boolean")
     */
    protected $searchable = true;

    /**
     * Set translatable locale
     *
     * @param string $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Set site
     *
     * @param  Site      $site
     * @return Directory
     */
    public function setSite(Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set searchable
     *
     * @param  boolean   $searchable
     * @return Directory
     */
    public function setSearchable($searchable)
    {
        $this->searchable = $searchable;

        return $this;
    }

    /**
     * Get searchable
     *
     * @return boolean
     */
    public function getSearchable()
    {
        return $this->searchable;
    }
}
