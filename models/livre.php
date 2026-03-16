<?php

class Livre 
{
    private int $id;
    private int $utilisateur_id;
    private string $titre;
    private string $auteur;
    private ?string $description;
    private ?string $image;
    private string $date_creation;
    private string $date_modification;
    private $disponible;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->utilisateur_id = $data['utilisateur_id'];
        $this->titre = $data['titre'];
        $this->auteur = $data['auteur'];
        $this->description = $data['description'] ?? null;
        $this->image = $data['image'] ?? null;
        $this->date_creation = $data['date_creation'];
        $this->date_modification = $data['date_modification'];
        $this->disponible = $data['disponible'];
    }

    // ===== Getters =====
    public function getId(): int { return $this->id; }
    public function getUtilisateurId(): int { return $this->utilisateur_id; }
    public function getTitre(): string { return $this->titre; }
    public function getAuteur(): string { return $this->auteur; }
    public function getDescription(): ?string { return $this->description; }
    public function getImage(): ?string { return $this->image; }
    public function getDateCreation(): string { return $this->date_creation; }
    public function getDateModification(): string { return $this->date_modification; }
    public function getDisponible(): bool { return $this->disponible; }

    // Méthode pratique pour obtenir un résumé du contenu
    public function getContent(int $length = 200): string
    {
        return substr($this->description ?? '', 0, $length);
    }

    public function getTitle(): string
    {
        return $this->titre;
    }

}