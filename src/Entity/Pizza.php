<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pizza")
 * @ORM\Entity(repositoryClass="App\Repository\PizzaRepository")
 */
class Pizza
{
    /**
     * @var int
     * @ORM\Column(name="id_pizza", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private string $nom;

    /**
     * @var Collection
     */
    private Collection $quantiteIngredients;

    /**
     * @ORM\ManyToMany(targetEntity=Pizzeria::class, mappedBy="pizza")
     */
    private $pizzerias;

    /**
     * @ORM\OneToMany(targetEntity=IngredientPizza::class, mappedBy="pizza", orphanRemoval=true)
     */
    private $ingredientPizza;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->quantiteIngredients = new ArrayCollection();
        $this->pizzerias = new ArrayCollection();
        $this->ingredientPizza = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Pizza
     */
    public function setId(int $id): Pizza
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Pizza
     */
    public function setNom(string $nom): Pizza
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @param IngredientPizza $quantiteIngredients
     * @return Pizza
     */
    public function addQuantiteIngredients(IngredientPizza $quantiteIngredients): Pizza
    {
        $this->quantiteIngredients[] = $quantiteIngredients;

        return $this;
    }

    /**
     * @param IngredientPizza $quantiteIngredients
     */
    public function removeQuantiteIngredient(IngredientPizza $quantiteIngredients): void
    {
        $this->quantiteIngredients->removeElement($quantiteIngredients);
    }

    /**
     * @return Collection
     */
    public function getQuantiteIngredients(): Collection
    {
        return $this->quantiteIngredients;
    }

    /**
     * @return Collection|Pizzeria[]
     */
    public function getPizzerias(): Collection
    {
        return $this->pizzerias;
    }

    public function addPizzeria(Pizzeria $pizzeria): self
    {
        if (!$this->pizzerias->contains($pizzeria)) {
            $this->pizzerias[] = $pizzeria;
            $pizzeria->addPizza($this);
        }

        return $this;
    }

    public function removePizzeria(Pizzeria $pizzeria): self
    {
        if ($this->pizzerias->removeElement($pizzeria)) {
            $pizzeria->removePizza($this);
        }

        return $this;
    }

    /**
     * @return Collection|IngredientPizza[]
     */
    public function getIngredientPizza(): Collection
    {
        return $this->ingredientPizza;
    }

    public function addIngredientPizza(IngredientPizza $ingredientPizza): self
    {
        if (!$this->ingredientPizza->contains($ingredientPizza)) {
            $this->ingredientPizza[] = $ingredientPizza;
            $ingredientPizza->setPizza($this);
        }

        return $this;
    }

    public function removeIngredientPizza(IngredientPizza $ingredientPizza): self
    {
        if ($this->ingredientPizza->removeElement($ingredientPizza)) {
            // set the owning side to null (unless already changed)
            if ($ingredientPizza->getPizza() === $this) {
                $ingredientPizza->setPizza(null);
            }
        }

        return $this;
    }
}