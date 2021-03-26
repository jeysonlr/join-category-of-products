<?php

declare(strict_types=1);

namespace Registers\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use ApiCore\Validation\ObjectCoreInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * join_test.join_produtos
 *
 * @ORM\Table(schema="join_test", name="join_produtos")
 * @ORM\Entity(repositoryClass="Registers\Repository\RegisterProductRepository")
 */
class RegisterProduct implements ObjectCoreInterface
{
    /**
     * @var int
     * @Type("int")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\SequenceGenerator(sequenceName="join_test.join_produtos_seq", allocationSize=1, initialValue=1)
     * @ORM\Column(name="id_produto", type="integer", nullable=false)
     */
    private int $id_produto;

    /**
     * @var int
     * @Type("int")
     * @ORM\Column(name="id_categoria_planejamento", type="integer", nullable=false)
     * @Assert\NotNull(message="O atributo id_categoria_planejamento é obrigatório")
     */
    private int $id_categoria_planejamento;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="nome_categoria", type="string", nullable=false)
     * @Assert\NotNull(message="O atributo nome_produto é obrigatório")
     */
    private string $nome_produto;

    /**
     * @var float
     * @Type("float")
     * @ORM\Column(name="valor_produto", type="float", nullable=false)
     * @Assert\NotNull(message="O atributo valor_produto é obrigatório")
     */
    private float $valor_produto;

    /**
     * @var DateTime
     * @Type("DateTime<'d/m/Y H:i:s'>")
     * @ORM\Column(name="data_cadastro", type="datetime", nullable=false)
     */
    private Datetime $data_cadastro;

    /**
     * @var RegisterCategory
     * @Type("<Registers\Entity\RegisterProduct>")
     *
     * @ORM\ManyToOne(targetEntity="RegisterCategory", cascade={"ALL"})
     * @ORM\JoinColumn(name="id_categoria_planejamento", referencedColumnName="id_categoria_planejamento")
     */
    private RegisterCategory $categoria;

    /**
     * @return int
     */
    public function getIdProduto(): int
    {
        return $this->id_produto;
    }

    /**
     * @param int $id_produto
     */
    public function setIdProduto(int $id_produto): void
    {
        $this->id_produto = $id_produto;
    }

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
    public function getNomeProduto(): string
    {
        return $this->nome_produto;
    }

    /**
     * @param string $nome_produto
     */
    public function setNomeProduto(string $nome_produto): void
    {
        $this->nome_produto = $nome_produto;
    }

    /**
     * @return float
     */
    public function getValorProduto(): float
    {
        return $this->valor_produto;
    }

    /**
     * @param float $valor_produto
     */
    public function setValorProduto(float $valor_produto): void
    {
        $this->valor_produto = $valor_produto;
    }

    /**
     * @return DateTime
     */
    public function getDataCadastro(): DateTime
    {
        return $this->data_cadastro;
    }

    /**
     * @param DateTime $data_cadastro
     */
    public function setDataCadastro(DateTime $data_cadastro): void
    {
        $this->data_cadastro = $data_cadastro;
    }

    /**
     * @return RegisterCategory
     */
    public function getCategoria(): RegisterCategory
    {
        return $this->categoria;
    }

    /**
     * @param RegisterCategory $categoria
     */
    public function setCategoria(RegisterCategory $categoria): void
    {
        $this->categoria = $categoria;
    }
}