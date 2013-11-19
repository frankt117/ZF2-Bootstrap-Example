<?php
namespace PtgTbProduct\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity (repositoryClass="\PtgTbProduct\Repository\Product\BulletPoint")
 * @ORM\Table(name="ptgtbproduct_product_bulletpoints")
 * @PtgBase\Doctrine\DiscriminatorEntry(value="PtgTbProduct\Entity\Product\BulletPoint")
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
     * @ORM\ManyToOne(targetEntity="PtgTbProduct\Entity\Product", inversedBy="BulletPoints")
     * @ORM\JoinColumn(name="ptgtbproduct_product_id", referencedColumnName="id")
     */
    protected $Product;

    /**
     * @ORM\Column(type="string")
     */
    protected $text;

    public function setProduct(\PtgTbProduct\Entity\Product $Product)
    {
        $this->Product = $Product;
    }
}