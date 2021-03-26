<?php

declare(strict_types=1);

namespace Registers\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use ApiCore\Validation\ObjectCoreInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * join_test.join_categorias_produtos
 *
 * @ORM\Table(schema="join_test", name="join_categorias_produtos")
 * @ORM\Entity(repositoryClass="Registers\Repository\RegisterCategoryRepository")
 */
class RegisterCategory implements ObjectCoreInterface
{
    /**
     * @var int
     * @Type("int")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\SequenceGenerator(sequenceName="join_test.join_categorias_produtos_seq", allocationSize=1, initialValue=1)
     * @ORM\Column(name="id_categoria_planejamento", type="integer", nullable=false)
     */
    protected int $id_categoria_planejamento;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="nome_categoria", type="integer", nullable=false)
     * @Assert\NotNull(message="O atributo nome_categoria é obrigatório")
     */
    protected string $nome_categoria;

    /**
     * @var RegisterProduct
     *
     * @Type("<Registers\Entity\RegisterProduct>")
     *
     * @ORM\OneToMany(targetEntity="RegisterProduct", mappedBy="categoria", cascade={"ALL"}, orphanRemoval=true)
     */
    protected RegisterProduct $produto;

    /**
     * @return int
     */
    public function getIdCategoriaPlanejamento(): int
    {
        return $this->id_categoria_planejamento;
    }

    /**
     * @param int $id_categoria_planejamento
     */
    public function setIdCategoriaPlanejamento(int $id_categoria_planejamento): void
    {
        $this->id_categoria_planejamento = $id_categoria_planejamento;
    }

    /**
     * @return string
     */
    public function getNomeCategoria(): string
    {
        return $this->nome_categoria;
    }

    /**
     * @param string $nome_categoria
     */
    public function setNomeCategoria(string $nome_categoria): void
    {
        $this->nome_categoria = $nome_categoria;
    }

    /**
     * @return RegisterProduct
     */
    public function getProduct(): RegisterProduct
    {
        return $this->produto;
    }

    /**
     * @param RegisterProduct $produto
     */
    public function setProduct(RegisterProduct $produto): void
    {
        $this->produto = $produto;
    }
}
