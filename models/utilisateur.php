<?php

class utilisateur
{
    private int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?string $mot_de_passe;
    private string $prenom;
    private string $nom;
    private string $biographie;
    private string $date_creation;
    private string $date_modification;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->pseudo = $data['pseudo'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->mot_de_passe = $data['mot_de_passe'] ?? null;

        $this->prenom = $data['prenom'] ?? '';
        $this->nom = $data['nom'] ?? '';
        $this->biographie = $data['biographie'] ?? '';
        $this->date_creation = $data['date_creation'] ?? '';
        $this->date_modification = $data['date_modification'] ?? '';
    }

    // ===== Getters =====
    public function getId(): int { return $this->id; }
    public function getPseudo(): ?string { return $this->pseudo; }
    public function getEmail(): ?string { return $this->email; }
    public function getMot_de_passe(): ?string { return $this->mot_de_passe; }
    public function getPrenom(): string { return $this->prenom; }
    public function getNom(): string { return $this->nom; }
    public function getBiographie(): string { return $this->biographie; }
    public function getDateCreation(): string { return $this->date_creation; }
    public function getDateModification(): string { return $this->date_modification; }

    // Méthode pratique pour obtenir un résumé du contenu
    public function getContent(int $length = 200): string
    {
        return substr($this->biographie ?? '', 0, $length);
    }

}