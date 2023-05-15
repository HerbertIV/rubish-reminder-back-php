<?php

namespace App\Dtos;

class UserDto extends BaseDto
{
    protected string $email;
    protected string $phone;
    protected ?string $firstName;
    protected ?string $lastName;
    protected ?int $regionId;
    protected bool $active;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    protected function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName ?? null;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName ?? null;
    }

    /**
     * @return int|null
     */
    public function getRegionId(): ?int
    {
        return $this->regionId ?? null;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'active' => $this->isActive(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'region_id' => $this->getRegionId(),
        ];
    }

    /**
     * @param string $phone
     */
    protected function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param string|null $firstName
     */
    protected function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string|null $lastName
     */
    protected function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param bool $active
     */
    protected function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @param int $regionId
     */
    protected function setRegionId(int $regionId): void
    {
        $this->regionId = $regionId;
    }
}
