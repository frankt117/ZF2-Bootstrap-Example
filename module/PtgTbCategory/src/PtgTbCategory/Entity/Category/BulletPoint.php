<?php
namespace PtgTbCategory\Entity\Category;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity (repositoryClass="\PtgTbCategory\Repository\Category\BulletPoint")
 * @ORM\Table(name="ptgtbcategory_category_bulletpoints")
 * @PtgBase\Doctrine\DiscriminatorEntry(value="PtgTbCategory\Entity\Category\BulletPoint")
 * @property string $text
 * @property int $id
 */
class BulletPoint
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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