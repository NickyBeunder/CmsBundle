<?php

namespace Opifer\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;
use Opifer\EavBundle\Model\EntityInterface;
use Opifer\EavBundle\Model\ValueSetInterface;
use Opifer\EavBundle\Model\TemplateInterface;
use Opifer\CrudBundle\Annotation\Form;

/**
 * Post entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="post")
 * @JMS\ExclusionPolicy("all")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Post implements EntityInterface
{
    /**
     * @var integer
     *
     * @JMS\Expose
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Form(editable=true)
     */
    protected $id;

    /**
     * @var Opifer\EavBundle\Entity\ValueSet
     *
     * @ORM\ManyToOne(targetEntity="ValueSet", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="valueset_id", referencedColumnName="id")
     * @Form(editable=true)
     */
    protected $valueSet;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="submitted_at", type="datetime")
     * @Form(editable=true)
     */
    protected $submittedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Form(editable=false)
     */
    protected $deletedAt;

    /**
     * @var TemplateInterface
     */
    public $template;

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
     * Set valueSet
     *
     * @param ValueSetInterface $valueSet
     *
     * @return Content
     */
    public function setValueSet(ValueSetInterface $valueSet = null)
    {
        $this->valueSet = $valueSet;

        return $this;
    }

    /**
     * Get valueSet
     *
     * @return ValueSetInterface
     */
    public function getValueSet()
    {
        if ($this->valueSet === null) {
            $this->valueSet = new ValueSet();
        }

        return $this->valueSet;
    }

    /**
     * Get created at
     *
     * @return \DateTime
     */
    public function getSubmittedAt()
    {
        return $this->submittedAt;
    }

    /**
     * Set submittedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return Post
     */
    public function setSubmittedAt($submittedAt)
    {
        $this->submittedAt = $submittedAt;

        return $this;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return File
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set template
     *
     * @param TemplateInterface $template
     *
     * @return Content
     */
    public function setTemplate(TemplateInterface $template = null)
    {
        $this->getValueSet()->setTemplate($template);

        return $this;
    }

    /**
     * Get template
     *
     * @return TemplateInterface
     */
    public function getTemplate()
    {
        return $this->getValueSet()->getTemplate();
    }
}
