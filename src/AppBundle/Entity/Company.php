<?php

namespace EasymedBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Company.
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="company")
 * @ORM\Entity()
 */
class Company extends ContactBase
{
    const STATUS_CUSTOMER = 1;

    const STATUS_PAST_CUSTOMER = 2;

    const STATUS_NON_CUSTOMER = 3;

    const STATUS_PROSPECT = 4;

    const STATUS_NON_PROSPECT = 5;

    const STATUS_LOST_PROSPECT = 6;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $customerStatus;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $prospectStatus;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="companies")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="EasymedBundle\Entity\Contact", mappedBy="company", cascade={"all"}, orphanRemoval=true)
     */
    protected $contacts;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerStatus()
    {
        return $this->customerStatus;
    }

    /**
     * @param mixed $customerStatus
     *
     * @return $this
     */
    public function setCustomerStatus($customerStatus)
    {
        $this->customerStatus = $customerStatus;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProspectStatus()
    {
        return $this->prospectStatus;
    }

    /**
     * @param mixed $prospectStatus
     *
     * @return $this
     */
    public function setProspectStatus($prospectStatus)
    {
        $this->prospectStatus = $prospectStatus;

        return $this;
    }

    /**
     * Returns array of customer statuses.
     *
     * @return []
     */
    public static function valuesOfCustomerStatus()
    {
        return [
            self::STATUS_CUSTOMER => 'Customer',
            self::STATUS_PAST_CUSTOMER => 'Past Customer',
            self::STATUS_NON_CUSTOMER => 'Non Customer',
        ];
    }

    /**
     * Returns array of prospect statuses.
     *
     * @return []
     */
    public static function valuesOfProspectStatus()
    {
        return [
            self::STATUS_PROSPECT => 'Prospect',
            self::STATUS_LOST_PROSPECT => 'Lost Prospect',
            self::STATUS_NON_PROSPECT => 'Non Prospect',
        ];
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
     * Add contact.
     *
     * @param Contact $contact Contact
     *
     * @return Company
     */
    public function addContact(Contact $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact.
     *
     * @param Contact $contact Contact
     */
    public function removeContact(Contact $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts.
     *
     * @return ArrayCollection
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}
