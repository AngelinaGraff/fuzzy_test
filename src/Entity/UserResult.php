<?php

namespace App\Entity;

use App\Repository\UserResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserResultRepository::class)]
class UserResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?array $correctAnswers = null;

    #[ORM\Column(nullable: true)]
    private ?array $incorrectAnswers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCorrectAnswers(): ?array
    {
        return $this->correctAnswers;
    }

    public function setCorrectAnswers(?array $correctAnswers): static
    {
        $this->correctAnswers = $correctAnswers;

        return $this;
    }

    public function getIncorrectAnswers(): ?array
    {
        return $this->incorrectAnswers;
    }

    public function setIncorrectAnswers(?array $incorrectAnswers): static
    {
        $this->incorrectAnswers = $incorrectAnswers;

        return $this;
    }
}
