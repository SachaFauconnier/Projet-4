<?php

/**
 * Classe qui gère les livres.
 */
class LivreManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les livres.
     * @return array : un tableau d'objets Livre.
     */
    public function getAllLivres() : array
    {
        $sql = "SELECT livre.*, utilisateur.pseudo 
        FROM livre
        JOIN utilisateur ON livre.utilisateur_id = utilisateur.id";
        $result = $this->db->query($sql);
        $livres = [];

        while ($livre = $result->fetch()) {
            $livres[] = new Livre($livre);
        }
        return $livres;
    }
    
    /**
     * Récupère un livre par son id.
     * @param int $id : l'id du livre.
     * @return Livre|null : un objet Livre ou null si le livre n'existe pas.
     */
   public function getLivreById(int $id) : ?array
{
    $sql = "SELECT livre.*, utilisateur.pseudo 
            FROM livre
            JOIN utilisateur ON livre.utilisateur_id = utilisateur.id
            WHERE livre.id = :id";

    $result = $this->db->query($sql, ['id' => $id]);
    $data = $result->fetch();

    if ($data) {
        return $data;
    }

    return null;
}

    public function getLastLivres(int $limit = 4): array
    {
        $limit = (int)$limit; // cast en entier pour sécurité
        $sql = "SELECT livre.*, utilisateur.pseudo 
        FROM livre
        JOIN utilisateur ON livre.utilisateur_id = utilisateur.id
        ORDER BY livre.id DESC 
        LIMIT $limit";
        
        $result = $this->db->query($sql); // query() existe dans DBManager

        $livres = [];
        while ($data = $result->fetch()) {
            $livres[] = new Livre($data);
        }

        return $livres;
    }

public function getLivresByUser(int $idUtilisateur): array
{
    $sql = "SELECT * FROM livre WHERE utilisateur_id = :id";
    
    $result = $this->db->query($sql, [
        'id' => $idUtilisateur
    ]);

    $livres = [];

    while ($data = $result->fetch()) {
        $livres[] = new Livre($data);
    }

    return $livres;
}
    public function searchLivres(string $search): array
{
       $sql = "SELECT livre.*, utilisateur.pseudo 
            FROM livre
            JOIN utilisateur ON livre.utilisateur_id = utilisateur.id
            WHERE titre LIKE :search 
            OR auteur LIKE :search";

    $result = $this->db->query($sql, [
        'search' => '%' . $search . '%'
    ]);

    $livres = [];

    while ($data = $result->fetch()) {
        $livres[] = new Livre($data);
    }

    return $livres;
}

public function deleteLivre(int $id): void
{
    $sql = "DELETE FROM livre WHERE id = :id";

    $this->db->query($sql, [
        'id' => $id
    ]);
}



public function updateLivre(
    int $id,
    string $titre,
    string $auteur,
    string $description,
    string $image,
    int $disponible
): void
{
    $sql = "UPDATE livre
            SET titre = :titre,
                auteur = :auteur,
                description = :description,
                image = :image,
                disponible = :disponible,
                date_modification = NOW()
            WHERE id = :id";

    $this->db->query($sql, [
        'id' => $id,
        'titre' => $titre,
        'auteur' => $auteur,
        'description' => $description,
        'image' => $image,
        'disponible' => $disponible
    ]);
}
}
