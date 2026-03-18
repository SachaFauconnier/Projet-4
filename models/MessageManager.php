<?php

class MessageManager extends AbstractEntityManager
{
    public function getConversationsByUser(int $userId): array
    {
        $sql = "
            SELECT 
                u.id,
                u.pseudo,
                MAX(m.date_creation) AS last_date
            FROM message m
            JOIN utilisateur u 
                ON u.id = CASE 
                    WHEN m.expediteur_id = :userId THEN m.destinataire_id
                    ELSE m.expediteur_id
                END
            WHERE m.expediteur_id = :userId OR m.destinataire_id = :userId
            GROUP BY u.id, u.pseudo
            ORDER BY last_date DESC
        ";

        $result = $this->db->query($sql, ['userId' => $userId]);

        $conversations = [];
        while ($data = $result->fetch()) {
            $conversations[] = $data;
        }

        return $conversations;
    }

    public function getMessagesBetweenUsers(int $userId, int $otherUserId): array
    {
        $sql = "
            SELECT m.*, u.pseudo AS expediteur_pseudo
            FROM message m
            JOIN utilisateur u ON u.id = m.expediteur_id
            WHERE 
                (m.expediteur_id = :userId AND m.destinataire_id = :otherUserId)
                OR
                (m.expediteur_id = :otherUserId AND m.destinataire_id = :userId)
            ORDER BY m.date_creation ASC
        ";

        $result = $this->db->query($sql, [
            'userId' => $userId,
            'otherUserId' => $otherUserId
        ]);

        $messages = [];
        while ($data = $result->fetch()) {
            $messages[] = $data;
        }

        return $messages;
    }

    public function sendMessage(int $expediteurId, int $destinataireId, string $contenu): void
    {
        $sql = "
            INSERT INTO message (expediteur_id, destinataire_id, contenu)
            VALUES (:expediteur_id, :destinataire_id, :contenu)
        ";

        $this->db->query($sql, [
            'expediteur_id' => $expediteurId,
            'destinataire_id' => $destinataireId,
            'contenu' => $contenu
        ]);
    }
}