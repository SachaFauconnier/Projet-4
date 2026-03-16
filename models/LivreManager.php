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
        $sql = "SELECT * FROM livre";
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
        $sql = "SELECT * FROM livre ORDER BY id DESC LIMIT $limit";
        
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
    
}
