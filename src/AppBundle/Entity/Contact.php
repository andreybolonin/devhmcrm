<?php

namespace EasymedBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contact.
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity()
 */
class Contact extends Base
{
    const TYPE_PERSON = 1;

    const TYPE_COMPANY = 2;

    /**
     * @ORM\ManyToOne(targetEntity="EasymedBundle\Entity\Person", inversedBy="contacts")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    protected $person;

    /**
     * @ORM\ManyToOne(targetEntity="EasymedBundle\Entity\Company", inversedBy="contacts")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    protected $company;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=255)
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="Deal", mappedBy="contact")
     */
    protected $deals;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="contacts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->deals = new ArrayCollection();
    }

    /**
     * Return array of contact type.
     *
     * @return []
     */
    public static function valueOfContactType()
    {
        return [
            self::TYPE_PERSON => 'Person',
            self::TYPE_COMPANY => 'Company',
        ];
    }

    /**
     * @return mixed
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param mixed $person
     *
     * @return $this
     */
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     *
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeals()
    {
        return $this->deals;
    }

    /**
     * @param mixed $deals
     *
     * @return $this
     */
    public function setDeals($deals)
    {
        $this->deals = $deals;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        $name = null;
        switch ($this->getType()) {

            case self::TYPE_PERSON:
                $name = $this->getPerson()->getFullName();
                break;

            case self::TYPE_COMPANY:
                $name = $this->getCompany()->getName();
                break;
        }

        return $name;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Add deal.
     *
     * @param Deal $deal Deal
     *
     * @return $this
     */
    public function addDeal(Deal $deal)
    {
        $this->deals[] = $deal;

        return $this;
    }

    /**
     * Remove deal.
     *
     * @param Deal $deal Deal
     */
    public function removeDeal(Deal $deal)
    {
        $this->deals->removeElement($deal);
    }
}
