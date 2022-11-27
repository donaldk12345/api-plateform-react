<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *
 * @ApiResource(
 *   attributes={"order"={"createdAt": "DESC"}},
 *   itemOperations={
 *     "delete",
 *     "put",
 *      "get"
 *     
 *     
 *      },
 *   collectionOperations={
 *         "get",
 *          "post"
 *         
 *           
 *      },
 *    normalizationContext={"groups"={"article:read"}},
 *    denormalizationContext={"groups"={"post"}}
 *    
 *    
 *   
 * 
 *   )
 * @ApiFilter(
 * 
 *   DateFilter::class,
 *   properties={
 *     "createdAt": "ASC"
 * }
 * 
 * )
 *
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"article:read"})
     */
    private $id;

    /**
     * @Groups({"article:read","post"})
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Groups({"article:read","post"})
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @Groups({"article:read","post"})
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="article")
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    private $category;

    /**
     * @Groups({"article:read","post"})
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;
    


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        //$this->images = new ArrayCollection();
   
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

  
  

 
 
}
