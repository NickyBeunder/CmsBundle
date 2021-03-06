<?php

namespace Opifer\CmsBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Opifer\CrudBundle\Annotation as Opifer;

/**
 * Menu
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="Opifer\CmsBundle\Repository\MenuRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"menu"="Menu", "group" = "MenuGroup", "item" = "MenuItem"})
 *
 */
class Menu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128)
     * @Assert\NotBlank()
     * @Gedmo\Translatable
     * @Opifer\Form(editable=true)
     */
    protected $name;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    protected $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    protected $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    protected $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    protected $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     * @Opifer\Form(editable=true)
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="parent")
     * @ORM\OrderBy({"sort" = "ASC"})
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     * @Opifer\Form(editable=true)
     */
    protected $site;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort", type="integer")
     */
    protected $sort = 0;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get indented name which is used by Form Types to build
     * a nested view in selects
     *
     * @return string
     */
    public function getIndentedName()
    {
        return str_repeat(". . . . ", $this->lvl).$this->name;
    }

    /**
     * Set translatable locale
     *
     * @param string $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return Menu
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lft
     *
     * @param  integer $lft
     * @return Menu
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param  integer $lvl
     * @return Menu
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param  integer $rgt
     * @return Menu
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param  integer $root
     * @return Menu
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set parent
     *
     * @param  \Opifer\CmsBundle\Entity\Menu $parent
     * @return Menu
     */
    public function setParent(\Opifer\CmsBundle\Entity\Menu $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Opifer\CmsBundle\Entity\Menu
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param  \Opifer\CmsBundle\Entity\Menu $children
     * @return Menu
     */
    public function addChild(\Opifer\CmsBundle\Entity\Menu $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Opifer\CmsBundle\Entity\Menu $children
     */
    public function removeChild(\Opifer\CmsBundle\Entity\Menu $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Check whether this menu item has children
     *
     * @return boolean
     */
    public function hasChildren()
    {
        return count($this->children) ? true : false;
    }

    /**
     * Set site
     *
     * @param  \Opifer\CmsBundle\Entity\Site $site
     * @return Menu
     */
    public function setSite(\Opifer\CmsBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \Opifer\CmsBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set sort
     *
     * @param  integer $sort
     * @return Menu
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return integer
     */
    public function getSort()
    {
        return $this->sort;
    }
}
