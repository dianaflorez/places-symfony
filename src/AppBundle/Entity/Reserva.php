<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reserva
 *
 * @ORM\Table(name="reserva")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservaRepository")
 */
class Reserva
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var int
     *
     * @ORM\Column(name="asistentes", type="integer")
     * /**
     * @Assert\Range(
     *      min = 1,
     *      max = 15,
     *      minMessage = "El numero minimo de asistentes es {{ limit }} tall to enter",
     *      maxMessage = "El numero maximo de asistentes es {{ limit }} to enter"
     * )
     */

    private $asistentes;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text")
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="reservas")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private $usuario;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Reserva
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set asistentes
     *
     * @param integer $asistentes
     *
     * @return Reserva
     */
    public function setComensales($asistentes)
    {
        $this->asistentes = $asistentes;

        return $this;
    }

    /**
     * Get asistentes
     *
     * @return int
     */
    public function getComensales()
    {
        return $this->asistentes;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Reserva
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Reserva
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set asistentes
     *
     * @param integer $asistentes
     *
     * @return Reserva
     */
    public function setAsistentes($asistentes)
    {
        $this->asistentes = $asistentes;

        return $this;
    }

    /**
     * Get asistentes
     *
     * @return integer
     */
    public function getAsistentes()
    {
        return $this->asistentes;
    }
}
