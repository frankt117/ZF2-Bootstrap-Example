<?php
namespace PtgTbCategory\Entity\Category;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity (repositoryClass="\PtgTbCategory\Repository\Category\BulletPoint")
 * @ORM\Table(name="ptglead_lead_phonenumbers")
 * @PtgBase\Doctrine\DiscriminatorEntry(value="PtgTbCategory\Entity\Category\BulletPoint")
 */
class BulletPoint
{
    /**
     * @ORM\ManyToOne(targetEntity="PtgTbCategory\Entity\Category", inversedBy="BulletPoints")
     * @ORM\JoinColumn(name="ptgtbcategory_category_id", referencedColumnName="id")
     */
    protected $Category;

    /**
     * @ORM\Column(type="string")
     */
    protected $text;

    public function setCategory(\PtgTbCategory\Entity\Category $Category)
    {
        $this->Category = $Category;
    }
}