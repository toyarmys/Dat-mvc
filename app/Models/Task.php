<?php
namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tasks")
 */
class Task
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /** 
     * @ORM\Column(type="string") 
     */
    protected $title;
    /** @ORM\Column(length=2000, nullable=true) */
    protected $description;
    /** @ORM\Column(type="datetime", nullable=true, columnDefinition="TIMESTAMP NULL") */
    protected $created_at;
    /** @ORM\Column(type="datetime", nullable=true, columnDefinition="TIMESTAMP NULL") */
    protected $updated_at;
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function __construct()
  {
    $this->created_at = new \DateTime();
    $this->updated_at = new \DateTime();
  }
  
  public function getCreated_at(){
    return $this->created_at;
  }

  public function setCreated_at($created_at){
    $this->created_at = new \DateTime($created_at);;
  }

  public function getUpdated_at(){
      return $this->updated_at;
  }

  public function setUpdated_at($updated_at){
      $this->updated_at = new \DateTime($updated_at);
  }
}
?>