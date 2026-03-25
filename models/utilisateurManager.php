<?php

class UtilisateurManager extends AbstractEntityManager
{
    /**
     * Récupère un utilisateur par son id
     */
    public function getUtilisateurById(int $id): ?Utilisateur
    {
        $sql = "SELECT * FROM utilisateur WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $data = $result->fetch();

        if ($data) {
            return new Utilisateur($data);
        }

        return null;
    }

    public function getUserByEmail(string $email): ?Utilisateur
    {
        $sql = "SELECT * FROM utilisateur WHERE email = :email";
        $result = $this->db->query($sql, ['email' => $email]);
        $data = $result->fetch();

        if ($data) {
            return new Utilisateur($data);
        }

        return null;
    }

    public function insertUtilisateur(string $pseudo, string $email, string $password): void
    {
        $sql = "INSERT INTO utilisateur (pseudo, email, mot_de_passe, date_creation)
                VALUES (:pseudo, :email, :password, NOW())";

        $this->db->query($sql, [
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function updateUtilisateurAvecMotDePasse(int $id, string $pseudo, string $email, string $password, ?string $avatar): void
    {
        $sql = "UPDATE utilisateur
                SET pseudo = :pseudo,
                    email = :email,
                    mot_de_passe = :password,
                    profile_image = :avatar,
                    date_modification = NOW()
                WHERE id = :id";

        $this->db->query($sql, [
            'id' => $id,
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $password,
            'avatar' => $avatar
        ]);
    }

    public function updateUtilisateurSansMotDePasse(int $id, string $pseudo, string $email, ?string $avatar): void
    {
        $sql = "UPDATE utilisateur
                SET pseudo = :pseudo,
                    email = :email,
                    profile_image = :avatar,
                    date_modification = NOW()
                WHERE id = :id";

        $this->db->query($sql, [
            'id' => $id,
            'pseudo' => $pseudo,
            'email' => $email,
            'avatar' => $avatar
        ]);
    }
    public function updateProfileImage(int $id, string $profileImage): void
    {
        $sql = "UPDATE utilisateur
                SET profile_image = :profile_image,
                    date_modification = NOW()
                WHERE id = :id";

        $this->db->query($sql, [
            'id' => $id,
            'profile_image' => $profileImage
        ]);
    }
}